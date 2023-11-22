<?php

use common\models\ValutazioneServizio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ValutazioneServizioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Valutazione Servizios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valutazione-servizio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Valutazione Servizio', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_cittadino',
            'nome_servizio',
            'overall_rating',
            'satisfaction_reason',
            //'angry_reason',
            //'notes:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ValutazioneServizio $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
