<?php

use common\models\Contravvenzione;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\Utils;

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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body lightgrey-bg-c1">
                <?= Html::a('Aggiungi Nuovo', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
                <div class="row mt-3">
                    <div class="table table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                'id',
                                'id_univoco_versamento',
                                'data_accertamento:datetime',
                                'targa',
                                [
                                    'attribute' => 'payed',
                                    'value' => function ($model) {
                                        $msg = $model->payed ? "SI" : "NO";
                                        $color = $model->payed ? "green" : "red";
                                        return "<span style='color:$color'>$msg</span>";
                                    },
                                    'format' => "raw",
                                ],
                                'data_pagamento:datetime',
                                'created_at:datetime',
                                [
                                    'class' => ActionColumn::className(),
                                    'urlCreator' => function ($action, Contravvenzione $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    }
                                ]
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>