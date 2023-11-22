<?php

use common\models\Contravvenzione;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ContravvenzioneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Contravvenzioni';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
?>
<div class="contravvenzione-index">

    <?= $this->render('_search', ['model' => $searchModel]);
    ?>
    <div class="row">
        <div class="col-12">
            <!--start card-->
            <div class="card-wrapper card-space">
                <div class="card card-bg card-big">
                    <div class="card-header">
                        <h3 class="card-title h5 ">Le tue contravvenzioni</h3>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'id',
                                    'amount:currency',
                                    'data_accertamento:date',
                                    'orario_accertamento:time',
                                    [
                                        'attribute' => 'targa',
                                        'value' => function ($model) {
                                            return strtoupper($model->targa);
                                        }
                                    ],
                                    [
                                        'attribute' => 'payed',
                                        'value' => function ($model) {
                                            return $model->payed ? '<svg class="icon icon-success bg-light"><use href="/bootstrap-italia/svg/sprites.svg#it-check-circle"></use></svg>' : '<svg class="icon icon-danger bg-light"><use href="/bootstrap-italia/svg/sprites.svg#it-close-big"></use></svg>';
                                        },
                                        'format' => "raw"
                                    ],
                                    [
                                        'class' => ActionColumn::className(),
                                        'urlCreator' => function ($action, Contravvenzione $model, $key, $index, $column) {
                                            return Url::toRoute([$action, 'id' => $model->id]);
                                        },
                                        'template' => "{view} {pay}",
                                        'buttons' => [
                                            'view' => function ($url, $model) {
                                                $html = '<a href="' . Url::to(["view", "id" => $model->id]) . '" class="btn btn-secondary btn-xs btn-icon" role="button" aria-disabled="true">
                                            <svg class="icon icon-white">
                                              <use
                                                xlink:href="/bootstrap-italia/svg/sprites.svg#it-info-circle"
                                              ></use>
                                            </svg>
                                            <span>Dettagli</span>
                                          </a>';

                                                return $html;
                                            },
                                            'pay' => function ($url, $model) {
                                                if ($model->payed) return "-";

                                                $html = '<a href="' . Url::to(["pay", "id" => $model->id]) . '" class="btn btn-xs btn-success btn-xs btn-icon" role="button" aria-disabled="true">
                                            <svg class="icon icon-white">
                                              <use
                                                xlink:href="/bootstrap-italia/svg/sprites.svg#it-card"
                                              ></use>
                                            </svg>
                                            <span>Paga</span>
                                          </a>';

                                                return $html;
                                            },
                                        ]
                                    ],
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>