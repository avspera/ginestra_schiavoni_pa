<?php

use common\models\AlboPretorio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Albo Pretorio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albo-pretorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <?= Html::a('Aggiungi Nuovo', ['create'], ['class' => 'btn btn-success']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'titolo',
            'numero_atto',
            'numero_affissione',
            'data_pubblicazione:date',
            'anno',
            [
                'attribute' => 'id_tipologia',
                'value' => function ($model) {
                    return $model->getTipologia();
                }
            ],
            [
                'attribute' => 'id_settore',
                'value' => function ($model) {
                    return $model->getSettore();
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => "{view} {update}"
            ],
        ],
    ]); ?>
</div>