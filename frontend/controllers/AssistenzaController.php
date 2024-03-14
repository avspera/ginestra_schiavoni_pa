<?php

namespace frontend\controllers;

use common\models\Assistenza;
use common\models\AssistenzaReply;
use common\models\AssistenzaReplySearch;
use common\models\AssistenzaSearch;
use common\models\Cittadino;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssistenzaController implements the CRUD actions for Assistenza model.
 */
class AssistenzaController extends Controller
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
     * Lists all Assistenza models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AssistenzaSearch();
        $loggedUser = Cittadino::getFakeCittadino();
        $searchModel->cf_richiedente = $loggedUser["fiscal_code"];
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Assistenza model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $replySearchModel = new AssistenzaReplySearch();
        $replySearchModel->id_assistenza = $id;
        $replies = $replySearchModel->search([]);

        return $this->render('view', [
            'model'     => $this->findModel($id),
            'replies'   => $replies,
            'replyModel' => new AssistenzaReply()
        ]);
    }

    /**
     * Creates a new Assistenza model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Assistenza();

        $loggedUser = Cittadino::getFakeCittadino();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(false)) {
                \Yii::$app->session->setFlash("success", "La richiesta di assistenza è stata presa in carico.");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::$app->session->setFlash("warning", "Non è stato possibile inoltrare la richiesta di assistenza. La invitiamo a riprovare");
            }
        }

        $model->loadDefaultValues();

        return $this->render('create', [
            'model' => $model,
            'loggedUser' => $loggedUser
        ]);
    }

    /**
     * Updates an existing Assistenza model.
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
     * Deletes an existing Assistenza model.
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
     * Finds the Assistenza model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Assistenza the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assistenza::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
