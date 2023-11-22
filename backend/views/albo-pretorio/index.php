<?php

use yii\helpers\Html;
use common\components\Utils;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Albo Pretorio';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
$models = $dataProvider->getModels();
$latestUpdate = !empty($models[count($models) - 1]) ? Utils::formatDate($models[count($models) - 1]->data_pubblicazione) : "N/A";
?>
<div class="albo-pretorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel, "latestUpdate" => $latestUpdate]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg card-big no-after">
            <div class="card-body lightgrey-bg-c1">
                <?= Html::a('Aggiungi Nuovo', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
                <div class="row mt-3">
                    <div class="table table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'titolo',
                                [
                                    'attribute' => 'numero_atto',
                                    'value' => function ($model) {
                                        return $model->numero_atto . "/" . $model->anno;
                                    }
                                ],
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
                                    'class' => ActionColumn::className(),
                                    'template' => "{view} {update}"
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>