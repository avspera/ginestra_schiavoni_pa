<?php

namespace backend\controllers;

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
        $token = $this->getToken();

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

        if ($response["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . $response["errore"]);
            return $this->redirect(Yii::$app->request->referrer);
        }

        //save IUV in my db
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
                    'causale' => $model->causale,
                    'importo' => floatval($model->amount),
                    'anno_competenza' => intval(date("Y"))
                ]
            ],
        ];

        return $structure;
    }

    private function inviaMultidovuto($params)
    {
        $token = $this->getToken();

        $url = Yii::$app->params["testEndPoint"] . "invia_multidovuto";
        
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $compressedParams = gzcompress($params, 9);
        $response = $curl->setPostParams([
            'applicazione' => 'pagamenti',
            'numero' => 1,
            'nome_flusso' => "0", //singolo pagamento
            'caricamento_da_confermare' => false,
            'content_json' => base64_encode($compressedParams),
        ])->post($url);
            
        $parsedResponse = $this->parseJsonResponse($response);
        return $parsedResponse;
    }

    private function getGestioneMultiflusso($model, $action)
    {
        $token = $this->getToken();
        $url = Yii::$app->params["testEndPoint"] . "gestione_multidovuto";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        $response = $curl->setGetParams([
            'applicazione' => 'pagamenti',
            'nome_flusso' => $model->nome_flusso,
            'id_flusso' => $model->id_flusso,
            'operazione' => $action
        ])->get($url);

        return $this->parseJsonResponse($response);
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
        $statoFlusso = $this->getGestioneMultiflusso($model, "info");
        
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

    private function modificaDovuto($id)
    {
        $model = $this->findModel($id);
        $token = $this->getToken();

        $url = Yii::$app->params["testEndPoint"] . "modifica_dovuto";

        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
        ]);

        $response = $curl->setPostParams([
            'applicazione'  => 'pagamenti',
            'tipo_dovuto'   => 'a',
            'id_univoco_dovuto' => $model->id_univoco_dovuto,
            'iuv' => $model->id_univoco_versamento,
            'causale'   => $model->causale,
            'importo'   => $model->amount,
            'scadenza'  => $model->scadenza
        ])->post($url);

        $parsedResponse = $this->parseJsonResponse($response);

        return $parsedResponse;
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
            $parsedResponse = $this->modificaDovuto($id);
            
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
        $token = $this->getToken();

        $url = Yii::$app->params["testEndPoint"] . "scarica_avviso";

        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $response = $curl->setGetParams([
            'applicazione' => 'pagamenti',
            'iuv' => $model->id_univoco_versamento
        ])->get($url);

        $parsedResponse = $this->parseJsonResponse($response);

        if ($parsedResponse["esito"] == "ko") {
            Yii::$app->session->setFlash("error", "Errore critico: " . $parsedResponse["errore"]);
            return $this->redirect(Yii::$app->request->referrer);
        }
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
            $changeStatus = $this->getGestioneMultiflusso($model, "elimina");
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
