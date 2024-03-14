<?php

use common\models\ParcheggioResidenti;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidentiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Parcheggio Residenti';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="parcheggio-residenti-index">

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
                                [
                                    'attribute' => 'cittadino',
                                    'value' => function ($model) {
                                        if (is_numeric($model->cittadino)) {
                                            return Utils::getCittadino($model->cittadino);
                                        } else {
                                            return $model->cittadino;
                                        }
                                    }
                                ],
                                'indirizzo',
                                'qnt_auto',
                                // [
                                //     'attribute' => "price",
                                //     'value' => function ($model) {
                                //         return Utils::formatCurrency($model->price);
                                //     }
                                // ],
                                [
                                    'attribute' => 'durata',
                                    'value' => function ($model) {
                                        return $model->getDurata();
                                    }
                                ],
                                [
                                    'attribute' => 'payed',
                                    "value" => function ($model) {
                                        return $model->payed ? "SI" : "NO";
                                    }
                                ],
                                'created_at:date',
                                //'updated_at',
                                //'created_by',
                                //'updated_by',

                                [
                                    'class' => ActionColumn::className(),
                                    'urlCreator' => function ($action, ParcheggioResidenti $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    }
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>