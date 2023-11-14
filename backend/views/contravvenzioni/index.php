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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contravvenzione-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aggiungi Contravvenzione', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'amount',
                'value' => function($model){
                    return Utils::formatCurrency($model->amount);
                }
            ],
            'articolo_codice',
            'data_accertamento:datetime',
            'targa',
            [
                'attribute' => 'payed',
                'value' => $searchModel->payed ? "SI" : "NO"
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
