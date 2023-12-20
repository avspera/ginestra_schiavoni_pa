<?php

namespace frontend\controllers;

use common\models\AlboPretorio;
use common\models\AlboPretorioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\csvgrid\CsvGrid;
use common\components\Utils;
use yii\data\Pagination;

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
        $dataProvider = $searchModel->searchCurl($this->request->queryParams);
        // $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider->sort->defaultOrder = ["numero_atto" => SORT_DESC];
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
        $searchModel = new AlboPretorioSearch();
        $model = $searchModel->getCurl($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }


    public function actionExport()
    {

        $params = \Yii::$app->request->get();

        $model = new AlboPretorioSearch();
        $dataProvider = $model->searchCurl($params);

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
                    'attribute' => 'oggetto'
                ],
                [
                    'attribute' => 'id_tipologia',
                    'value' => function ($model) {
                        $tipologia = $model->getTipologia($model->id_tipologia);
                        return isset($tipologia["descrizioneDocumento"]) ? $tipologia["descrizioneDocumento"] : "-";
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
