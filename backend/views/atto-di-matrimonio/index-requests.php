<?php

use common\models\AttoDiMatrimonio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Atti Di Matrimonio';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="atto-di-matrimonio-index">

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card card-success" style="margin-top:10px;">
        <div class="card-header"><?= Html::a('Aggiungi Atto Di Matrimonio', ['create'], ['class' => 'btn btn-xs btn-success']) ?></div>
        <div class="card-body">
            <div class="table table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        [
                            'attribute' => 'coniuge_uno',
                            'value' => function ($model) {
                                if (is_numeric($model->coniuge_uno)) {
                                    return Utils::getCittadino($model->coniuge_uno);
                                } else {
                                    return $model->coniuge_uno;
                                }
                            },
                            'format' => "raw"
                        ],
                        [
                            'attribute' => 'coniuge_due',
                            'value' => function ($model) {
                                if (is_numeric($model->coniuge_due)) {
                                    return Utils::getCittadino($model->coniuge_due);
                                } else {
                                    return $model->coniuge_due;
                                }
                            },
                            'format' => "raw"
                        ],
                        'data_matrimonio:date',
                        'created_at:datetime',
                        [
                            'class' => ActionColumn::className(),
                            'template' => "{view} {update}",
                            'buttons' => [
                                'view' => function($url, $model){
                                    return Html::a("<button class='btn btn-xs btn-success'>Vedi</button>", Url::to(["view-request", "id" => $model->id])); 
                                },
                                'update' => function($url, $model){
                                    return Html::a("<button class='btn btn-xs btn-warning'>Modifica</button>", Url::to(["update-request", "id" => $model->id])); 
                                }
                            ]
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>