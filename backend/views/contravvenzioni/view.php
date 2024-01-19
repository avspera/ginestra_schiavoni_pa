<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = $model->id . " del " . Utils::formatDate($model->data_accertamento);
$this->params['breadcrumbs'][] = [
    'label' => 'Contravvenzioni',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];

\yii\web\YiiAsset::register($this);
?>
<div class="contravvenzione-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Genera pagamento PagoPa', ['generate-pagopa-item', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning']) ?>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => 'Sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'strumento',
                'value' => function($model){
                    return $model->getStrumento();
                }
            ],
            [
                'attribute' => 'amount',
                'value' => Utils::formatCurrency($model->amount)
            ],
            'articolo_codice',
            'data_accertamento:date',
            'orario_accertamento:time',
            [
                'attribute' => 'targa',
                'value' => function ($model) {
                    return strtoupper($model->targa);
                }
            ],
            'luogo',
            'punti_patente',
            [
                'attribute' => 'payed',
                'value' => function ($model) {
                    return $model->payed ? "SI" : "NO";
                }
            ],
            'data_pagamento:datetime',
            'ricevuta_pagamento',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => Utils::getCreatedBy($model->created_by)
            ],
            [
                'attribute' => 'updated_by',
                'value' => Utils::getCreatedBy($model->updated_by)
            ],
        ],
    ]) ?>

</div>