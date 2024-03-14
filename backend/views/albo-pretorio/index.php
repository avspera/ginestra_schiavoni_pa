<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
$latestUpdate = !empty($models[0]) ? Utils::formatDate($models[0]->data_pubblicazione) : "N/A";
?>
<div class="albo-pretorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel, "latestUpdate" => $latestUpdate]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body lightgrey-bg-c1">
                <div class="row mt-3">
                    <div class="table table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'id',
                                'oggetto',
                                'numero_atto',
                                'progressivo',
                                'numero_affissione',
                                'data_pubblicazione:date',
                                'anno',
                                [
                                    'attribute' => 'id_tipologia',
                                    'value' => function ($model) {
                                        $tipologia = $model->getTipologia($model->id_tipologia);
                                        return isset($tipologia["descrizioneDocumento"]) ? $tipologia["descrizioneDocumento"] : "-";
                                    }
                                ],
                                [
                                    'class' => ActionColumn::className(),
                                    'template' => "{view}",
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a("<button class='btn btn-xs btn-success'>Vedi</button>", Url::to(["view", "id" => $model->id]));
                                        }
                                    ]
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>