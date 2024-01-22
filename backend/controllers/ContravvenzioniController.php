<?php

namespace backend\controllers;

use Yii;
use common\models\Contravvenzione;
use common\models\ContravvenzioneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use linslin\yii2\curl;
use yii\web\HttpException;
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

    private function getTipoDovuti()
    {
        $token = Yii::$app->session->get("jwt_token");
        $url = Yii::$app->params["testEndPoint"] . "/tipi_dovuto";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"]
        ]);
        $response = $curl->get($url);
        $formatter = new JsonParser;
        $parsedResponse = $formatter->parse($response, 'json');
        $out = [];
        foreach ($parsedResponse["tipi_dovuto"] as $item) {
            if ($item["tipo_elemento"] == "multe") {
                $out = $item;
            }
        }
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

        $formatter = new JsonParser();
        $decodedResponse = $formatter->parse($response, 'json');

        if (!empty($decodedResponse)) {
            Yii::$app->session->set("jwt_token", $decodedResponse);
            return $decodedResponse;
        }

        return false;
    }

    public function actionGeneratePagopaItem($id)
    {
        $token = $this->authenticateWithJwt();
        if (!$token) {
            Yii::$app->session->setFlash("error", "Errore critico: impossibile connettersi a sistema DedaGroup");
            return $this->redirect(Yii::$app->request->referrer);
        }

        $tipo_dovuto = $this->getTipoDovuti();

        if ($tipo_dovuto["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . $tipo_dovuto["errore"]);
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model = $this->findModel($id);

        $structure = $this->parseInviaMultidovutoData($model);

        $response = $this->inviaMultidovuto(json_encode($structure));
    }

    private function parseInviaMultidovutoData($model)
    {
        $structure["pagatore"] = [
            'tipo_persona' => $model->tipo_persona,
            'nome' => $model->nome,
            'cognome' => $model->cognome,
            'cf' => $model->cf,
            'via' => $model->via,
            'civico' => $model->civico,
            'comune' => $model->comune,
            'cap' => $model->cap,
            'prov' => $model->prov,
            'nazione' => $model->nazione,
            'email' => $model->email
        ];

        $structure["data_documento"] = null;
        $structure["numero_protocollo"] = "";
        $structure["data_protocollo"] = null;
        $structure["dettaglio_riga1"] = null;
        $structure["dettaglio_riga2"] = null;
        $structure["dettaglio_riga3"] = null;
        $structure["dettaglio_riga4"] = null;
        $structure["dettaglio_riga5"] = null;
        $structure["istruttore_procedimento"] = null;
        $structure["telefono_procedimento"] = null;
        $structure["email_procedimento"] = null;
        $structure["note"] = null;
        $structure["id_doc_civilianext"] = null;
        $structure["url_documento"] = null;

        $structure["rate"][] = [
            "tipo_rata" => "U",
            'id_univoco_versamento' => null,
            'dovuti'    => [
                [
                    //'tipo_dovuto' => $tipo_dovuto['out']["tipo_elemento"],
                    'tipo_dovuto' => 'a',
                    'id_univoco_dovuto' => $model->getNextIdUnivocoDovuto(),
                    'causale' => "Contravvenzione N. " . $model->id . " del " . Yii::$app->formatter->asDate($model->data_accertamento) . " TARGA: " . $model->targa,
                    'importo' => floatval($model->amount),
                    'anno_competenza' => intval(date("Y"))
                ]
            ],
        ];

        return $structure;
    }
    private function inviaMultidovuto($params)
    {
        $token = Yii::$app->session->get("jwt_token");
        $url = Yii::$app->params["testEndPoint"] . "/invia_multidovuto";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $response = $curl->setPostParams([
            'applicazione' => 'pagamenti',
            'numero' => 1,
            'nome_flusso' => "0", //singolo pagamento
            'caricamento_da_confermare' => false,
            'content_json' => base64_encode($params),
        ])->post($url);

        $formatter = new JsonParser;
        $parsedResponse = $formatter->parse($response, 'json');
        print_r($parsedResponse);
        die;
    }
    /**
     * Displays a single Contravvenzione model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
