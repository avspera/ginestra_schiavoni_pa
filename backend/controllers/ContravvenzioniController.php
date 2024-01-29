<?php

namespace backend\controllers;

use common\components\ContravvenzioniApi;
use Yii;
use common\models\Contravvenzione;
use common\models\ContravvenzioneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use linslin\yii2\curl;
use yii\web\JsonParser;

/**
 * ContravvenzioniController implements the CRUD actions for Contravvenzione model.
 */
class ContravvenzioniController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Contravvenzione models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContravvenzioneSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    private function parseJsonResponse($response)
    {
        try {
            $formatter = new JsonParser;
            $parsedResponse = $formatter->parse($response, 'json');
            return $parsedResponse;
        } catch (yii\web\BadRequestHttpException $e) {
            return ["esito" => 'ko', "errore" => $response];
        }
    }
    private function getTipoDovuti()
    {
        $token = $this->getToken();
        $url = Yii::$app->params["testEndPoint"] . "/tipi_dovuto";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        $response = $curl->get($url);
        $parsedResponse = $this->parseJsonResponse($response);
        $out = [];
        if ($parsedResponse) {
            foreach ($parsedResponse["tipi_dovuto"] as $item) {
                if ($item["tipo_elemento"] == "multe") {
                    $out = $item;
                }
            }
        }
        print("<pre>");
        print_r($out);
        die;
        return [
            "esito" => $parsedResponse["esito"],
            "errore" => isset($parsedResponse["errore"]) ? $parsedResponse["errore"] : NULL,
            "out" => $out
        ];
    }

    private function authenticateWithJwt($ambiente = "test")
    {
        $url        = $ambiente !== "test" ? Yii::$app->params["paymentAuthUrl"] : Yii::$app->params["paymentAuthUrlTest"];
        $username   = $ambiente !== "test" ? Yii::$app->params["payUsername"] : Yii::$app->params["payUsernameTest"];
        $password   = $ambiente !== "test" ? Yii::$app->params["payPassword"] : Yii::$app->params["payPasswordTest"];
        $grantType  = Yii::$app->params["payGrantType"];
        //Init curl
        $curl = new curl\Curl();
        $response = $curl
            ->setPostParams([
                'username' => $username,
                'password' => $password,
                'grant_type' => $grantType
            ])->post($url);

        $decodedResponse = $this->parseJsonResponse($response);

        if (!empty($decodedResponse)) {
            Yii::$app->session->set("jwt_token", $decodedResponse);
            return $decodedResponse;
        }

        return false;
    }

    private function getToken()
    {
        $token = Yii::$app->session->get("jwt_token");
        //[expires_in] => 1799 [created_at] => 1706020921
        $expiresAt = date("Y-m-d H:i:s", $token["created_at"] + $token["expires_in"]);
        if (date("Y-m-d H:i:s", strtotime($expiresAt)) < date("Y-m-d H:i:s")) {
            $token = $this->authenticateWithJwt();
        }
        return $token;
    }

    public function actionGeneratePagopaItem($id)
    {
        $api = new ContravvenzioniApi();
        $token = $api->token;

        if (empty($token)) {
            Yii::$app->session->setFlash("error", "Errore critico: impossibile connettersi a sistema DedaGroup");
            return $this->redirect(Yii::$app->request->referrer);
        }

        $tipo_dovuto = $api->getTipoDovuti();

        if ($tipo_dovuto["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . $tipo_dovuto["errore"]);
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model = $this->findModel($id);

        $structure = $api->parseInviaMultidovutoData($model);

        $response = $api->inviaMultidovuto($structure, $model->id);

        if ($response["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . json_encode($response["errore"]));
            return $this->redirect(Yii::$app->request->referrer);
        }

        $decodedResponse = $api->parseContentJsonResponse($response["content_json"]);
        if ($decodedResponse["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . $decodedResponse["errore"]);
            return $this->redirect(Yii::$app->request->referrer);
        }

        $rate = $decodedResponse["content"][0]["rate"];
        $esito = "ok";
        foreach ($rate as $item) {
            $model->id_univoco_versamento = $item["id_univoco_versamento"];
            $model->id_flusso   = $response["id_flusso"];
            $model->nome_flusso = $response["nome_flusso"];
            $model->id_univoco_dovuto = isset($item["dovuti"][0]) ? $item["dovuti"][0]["id_univoco_dovuto"] : NULL;

            if (!$model->save(false)) {
                $esito = "ko";
                break;
            }
        }

        if ($esito == "ok") {
            Yii::$app->session->setFlash("success", "Operazione completata correttamente");
        } else {
            Yii::$app->session->setFlash("error", "Ops...c'è stato qualche problema. [ERR-CONTR 103]");
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays a single Contravvenzione model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $api = new ContravvenzioniApi();
        $statoFlusso = $api->getGestioneMultidovuto($model, "info");

        return $this->render('view', [
            'model' => $model,
            'statoFlusso' => $statoFlusso
        ]);
    }

    /**
     * Creates a new Contravvenzione model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Contravvenzione();
        $model->id = $model->getNextIdUnivocoDovuto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Ops...c\'è stato qualche problema. [CONTRAVVENZIONI-105] <pre>' . json_encode($model->getErrors(), JSON_PRETTY_PRINT) . "</pre>");
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contravvenzione model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $api = new ContravvenzioniApi();

            $parsedResponse = $api->modificaDovuto($model);

            if ($model->save(false) && $parsedResponse["esito"] == "ok") {
                Yii::$app->session->setFlash("success", "Operazione completata correttamente");
            } else {
                Yii::$app->session->setFlash("error", "Attenzione: Errore critico " . $parsedResponse["errore"]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * action Scarica avviso per stampare modello multa
     */
    public function actionScaricaAvviso($id)
    {
        $model = $this->findModel($id);
        $api = new ContravvenzioniApi();
        $parsedResponse = $api->scaricaAvviso($model->id_univoco_versamento);
        
        if ($parsedResponse["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . $parsedResponse["errore"]);
        } else {
            Yii::$app->session->setFlash("success", \yii\helpers\Html::a("Scarica avviso", \yii\helpers\Url::to([$parsedResponse["path"]])));
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
    /**
     * Deletes an existing Contravvenzione model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->stato !== $model->stato_choices_flipped["payed"]) {
            $model->stato = $model->stato_choices_flipped["deleted"];
            $api = new ContravvenzioniApi();
            $changeStatus = $api->getGestioneMultidovuto($model, "elimina");
            if ($changeStatus["esito"] == "ko") {
                Yii::$app->session->setFlash("error", "Errore: " . $changeStatus["errore"]);
            } else {
                $model->save(false);
                Yii::$app->session->setFlash("success", "Stato contravvenzione modificato correttamente");
            }
        } else {
            Yii::$app->session->setFlash("error", "Errore: non puoi cancellare una contravvenzione pagata");
        }

        return $this->redirect(["view", "id" => $model->id]);
    }

    public function actionDeletePermanent($id)
    {
        $deleted = $this->findModel($id)->delete();

        if ($deleted) {
            Yii::$app->session->setFlash("success", "Contravvenzione cancellata correttamente");
        } else {
            Yii::$app->session->setFlash("error", "Errore: non puoi cancellare una contravvenzione pagata");
        }

        return $this->redirect(["index"]);
    }

    /**
     * Finds the Contravvenzione model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Contravvenzione the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contravvenzione::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La pagina che cerchi non esiste');
    }
}
