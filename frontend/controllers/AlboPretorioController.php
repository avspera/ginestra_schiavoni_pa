<?php

namespace frontend\controllers;

use common\models\AlboPretorio;
use common\models\AlboPretorioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\csvgrid\CsvGrid;
use common\components\Utils;

/**
 * AlboPretorioController implements the CRUD actions for AlboPretorio model.
 */
class AlboPretorioController extends Controller
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
     * Lists all AlboPretorio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AlboPretorioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->sort->defaultOrder = ["numero_atto" => SORT_DESC];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AlboPretorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AlboPretorio();

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
     * Updates an existing AlboPretorio model.
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

    public function actionExport()
    {

        $params = \Yii::$app->request->get();
        
        $model = new AlboPretorioSearch();
        $dataProvider = $model->search($params);

        $exporter = new CsvGrid([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'numero_atto',
                ],
                [
                    'attribute' => 'numero_affissione',
                ],
                [
                    'attribute' => 'titolo'
                ],
                [
                    'attribute' => 'id_tipologia',
                    'value' => function ($model) {
                        return $model->getTipologia();
                    }
                ],
                [
                    'attribute' => 'id_atto_matrimonio',
                    'value' => function ($model) {
                        $atto = $model->getAttoDiMatrimonio();
                        return !empty($atto) ? Utils::getCittadino($atto->id_coniuge_uno) . " e  " . Utils::getCittadino($atto->id_coniuge_due) : "-";
                    }
                ],
                [
                    'attribute' => 'data_pubblicazione',
                    'format' => 'date',
                ],
                [
                    'attribute' => 'data_fine_pubblicazione',
                    'format' => 'date',
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'date',
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => 'date',
                ],
            ],
        ]);

        $filePath = 'downloads/albo_ginestra_degli_schiavoni_' . date("Y-m-d") . ".csv";
        $exporter->export()->saveAs($filePath);
        if (file_exists($filePath)) {
            \Yii::$app->response->sendFile($filePath, 'albo_finestra_degli_schiavoni_' . date("Y-m-d") . ".csv");
        }
    }

    /**
     * Deletes an existing AlboPretorio model.
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
     * Finds the AlboPretorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AlboPretorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlboPretorio::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
