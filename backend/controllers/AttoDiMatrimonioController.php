<?php

namespace backend\controllers;

use common\models\AlboPretorio;
use common\models\AlboPretorioSearch;
use common\models\AttoDiMatrimonio;
use common\models\AttoDiMatrimonioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Utils;

/**
 * AttoDiMatrimonioController implements the CRUD actions for AttoDiMatrimonio model.
 */
class AttoDiMatrimonioController extends Controller
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
     * Lists all AttoDiMatrimonio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AlboPretorioSearch();
        $searchModel->id_tipologia = 710;
        $dataProvider = $searchModel->searchCurl($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexRequests()
    {
        $searchModel = new AttoDiMatrimonioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->sort->defaultOrder = ["created_at" => SORT_DESC];
        return $this->render('index-requests', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AttoDiMatrimonio request from user model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewRequest($id)
    {
        return $this->render('view-request', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Displays a single AlboPretorio model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new AlboPretorioSearch();
        $model = $searchModel->getCurl($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        $model->approved = 1;
        $model->approved_by = \Yii::$app->user->identity->id;

        if ($model->save(false)) {
            \Yii::$app->session->setFlash("success", "Atto di matrimonio approvato correttamente");
        } else {
            \Yii::$app->session->setFlash("warning", "Ops...c'è stato qualche problema");
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionPublish($id)
    {
        $model = $this->findModel($id);

        $latestAtto = AlboPretorio::find()->select(["numero_atto", "numero_affissione"])->orderBy(["numero_atto" => SORT_DESC])->one();

        $model->published = 1;
        $model->published_by = \Yii::$app->user->identity->id;
        if ($model->save(false)) {
            /**
             * 'numero_atto', 'anno', 'id_tipologia', 'data_pubblicazione', 'created_at', 'created_by', 'titolo'
             */
            $alboPretorio = new AlboPretorio();
            $alboPretorio->oggetto = "Pubblicazione di Matrimonio del " . Utils::formatDate($model->data_matrimonio);
            $alboPretorio->numero_atto = !empty($latestAtto) ? $latestAtto->numero_atto + 1 : 1;
            $alboPretorio->numero_affissione = !empty($latestAtto) ? $latestAtto->numero_affissione + 1 : 1;
            $alboPretorio->anno = date("Y");
            $alboPretorio->id_tipologia = $alboPretorio->tipologia_matrimonio;
            $alboPretorio->data_pubblicazione = date("Y-m-d H:i:s");
            $alboPretorio->sorgente = $alboPretorio->sorgente_matrimonio;
            $alboPretorio->id_atto_matrimonio = $model->id;
            $alboPretorio->data_fine_pubblicazione = date('Y-m-d', strtotime($alboPretorio->data_pubblicazione . ' + 8 days'));

            if ($alboPretorio->save(false)) {
                \Yii::$app->session->setFlash("success", "Atto di matrimonio pubblicato correttamente nell'albo pretorio");
                $model->id_albo_pretorio = $alboPretorio->id;
                $model->save(false);
            } else {
                \Yii::$app->session->setFlash("warning", "Ops...non riesco a pubblicare l'atto di matrimonio nell'albo pretorio");
            }
        } else {
            \Yii::$app->session->setFlash("warning", "Ops...non riesco a salvare l'atto di matrimonio");
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Creates a new AttoDiMatrimonio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AttoDiMatrimonio();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AttoDiMatrimonio model.
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
     * Deletes an existing AttoDiMatrimonio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->published) {
            \Yii::$app->session->setFlash("error", "Non puoi cancellare un atto di matrimonio pubblicato");
            return $this->redirect($this->request->referrer);
        }

        $model->delete();
        \Yii::$app->session->setFlash("success", "Operazione completata correttamente");

        return $this->redirect(['index']);
    }

    /**
     * Finds the AttoDiMatrimonio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AttoDiMatrimonio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AttoDiMatrimonio::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
