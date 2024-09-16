<?php

namespace frontend\controllers;

use Yii;
use common\models\AccessoAtti;
use common\models\AccessoAttiSearch;
use common\components\Utils;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessoAttiController implements the CRUD actions for AccessoAtti model.
 */
class AccessoAttiController extends Controller
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
        $searchModel = new AccessoAttiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

        if ($model->stato_richiesta == Utils::getStatoRichiestaFlipped("da_completare")) {
            return $this->redirect(["create", "id" => $model->id]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new Contravvenzione model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id = NULL)
    {
        if (!empty($id)) {
            $model = AccessoAtti::find()->where(["id" => $id])->one();
        } else {
            $model = new AccessoAtti();
            $model->id_cittadino = 1;
            $model->step = 1;

            try {
                $model->save(false);
            } catch (Exception $e) {
                Yii::$app->session->setFlash("error", "Impossibile procedere: " . $e->getMessage());
            }
        }

        if ($this->request->isPost || $this->request->isAjax) {

            $model->load($this->request->post());

            if ($model->step == 4) {
                $model->stato_richiesta = Utils::getStatoRichiestaFlipped("in_lavorazione");
            }

            try {
                $model->save(false);

                if ($this->request->isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ["status" => 200];
                }

                $cittadino = \common\models\Cittadino::find()->select(["id", "email"])->where(["id" => $model->id_cittadino])->one();

                return $this->render('confirmed', ['model' => $model, "cittadino" => $cittadino]);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', 'Ops...c\'è stato qualche problema. [ACCESSO-ATTI-105] <pre>' . json_encode($model->getErrors(), JSON_PRETTY_PRINT) . "</pre>");

                if ($this->request->isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ["status" => 100, "msg" => $e->getMessage()];
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionConfirmed($id)
    {
        $model = $this->findModel($id);
        $cittadino = \common\models\Cittadino::find()->select(["id", "email"])->where(["id" => $model->id_cittadino])->one();

        return $this->render('confirmed', ['model' => $model, "cittadino" => $cittadino]);
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save(false)) {
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
        if (($model = AccessoAtti::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
