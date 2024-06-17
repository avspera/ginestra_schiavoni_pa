<?php

namespace frontend\controllers;

use common\components\ContravvenzioniApi;
use Yii;
use common\models\Contravvenzione;
use common\models\ContravvenzioneSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $queryParams = $this->request->queryParams;

        if (isset($queryParams["ContravvenzioneSearch"]["id"])) {
            $dataProvider = $searchModel->search($queryParams);
        } else {
            $dataProvider = new \yii\data\ArrayDataProvider();
        }

        $api = new ContravvenzioniApi();
        $tipoDovuto = $api->getTipoDovuti();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tipoDovuto' => $tipoDovuto
        ]);
    }

    public function actionPrePay($id)
    {
        if (empty($id)) {
            return $this->goBack();
        }
        return $this->render("pre-pay", ["id" => $id]);
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

    public function actionPay($id)
    {
        return $this->render('pay', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * search for given iuv input
     * @param String $cf - codice fiscale pagatore
     * @param String $iuv - iuv pagamento
     */
    public function actionSearch($cf, $iuv)
    {
        if (Yii::$app->request->isAjax) {
            $out = ["status" => 100, "msg" => "", "data" => []];
            $contravvenzione = Contravvenzione::findOne(["cf" => $cf, "id_univoco_versamento" => $iuv]);

            if (empty($contravvenzione)) {
                $out["msg"] = "Contravvenzione non trovata. Controlla i dati inseriti";
                return json_encode($out);
            }

            $api = new ContravvenzioniApi();
            $searchResult = $api->statoPagamenti($contravvenzione);

            if ($searchResult["esito"] == "ko") {
                $out["msg"] = $searchResult["errore"];
            } else {
                $out["data"] = $searchResult;
                $out["status"] = 200;
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $out;
        }

        return false;
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

    public function actionEsitoOk()
    {
        return $this->render("esito-ok");
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
