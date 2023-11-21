<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = "Contravvenzione #" . $model->id . " del " . Utils::formatDate($model->data_accertamento);
$this->params['breadcrumbs'][] = [
    'label' => 'Contravvenzioni',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

// $this->params['breadcrumbs'][] = ['label' => 'Contravvenziones', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

?>
<div class="contravvenzione-view">

    <div class="row">
        <div class="col-12">
            <!--start card-->
            <div class="card-wrapper card-space">
                <div class="card card-bg card-big">
                    <div class="card-header">
                        <h1><?= Html::encode($this->title) ?></h1>
                        <?php
                        if (!$model->payed) {
                            echo '<a href="' . Url::to(["pay", "id" => $model->id]) . '" class="btn btn-success btn-xs btn-icon" role="button" aria-disabled="true">
                                <svg class="icon icon-white">
                                    <use
                                    xlink:href="/bootstrap-italia/svg/sprites.svg#it-card"
                                    ></use>
                                </svg>
                                <span>Paga</span>
                                </a>';
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'amount:currency',
                                'articolo_codice',
                                [
                                    'attribute' => 'targa',
                                    'value' => function ($model) {
                                        return strtoupper($model->targa);
                                    }
                                ],
                                'data_accertamento:datetime',
                                'punti_patente',
                                [
                                    'attribute' => 'payed',
                                    'value' => $model->payed ? '<svg class="icon icon-success bg-light"><use href="/bootstrap-italia/svg/sprites.svg#it-check-circle"></use></svg>' : '<svg class="icon icon-danger bg-light"><use href="/bootstrap-italia/svg/sprites.svg#it-close-big"></use></svg>',
                                    'format' => "raw"
                                ],
                                'data_pagamento:datetime',
                                'ricevuta_pagamento',
                                'created_at:datetime',
                                [
                                    'attribute' => 'created_by',
                                    'value' => function ($model) {
                                        return Utils::getCreatedBy($model->created_by);
                                    }
                                ],
                                [
                                    'attribute' => 'updated_by',
                                    'value' => function ($model) {
                                        return Utils::getCreatedBy($model->updated_by);
                                    }
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>