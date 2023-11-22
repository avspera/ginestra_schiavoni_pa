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
                            'attribute' => 'id_coniuge_uno',
                            'value' => function ($model) {
                                return Html::a(Utils::getCittadino($model->id_coniuge_uno), Url::to(["cittadino/view", "id" => $model->id_coniuge_uno]));
                            },
                            'format' => "raw"
                        ],
                        [
                            'attribute' => 'id_coniuge_due',
                            'value' => function ($model) {
                                return Html::a(Utils::getCittadino($model->id_coniuge_due), Url::to(["cittadino/view", "id" => $model->id_coniuge_due]));
                            },
                            'format' => "raw"
                        ],
                        'data_matrimonio:date',
                        'created_at:datetime',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, AttoDiMatrimonio $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>