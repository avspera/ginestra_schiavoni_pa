<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = $model->id." del ".Utils::formatDate($model->data_accertamento);
$this->params['breadcrumbs'][] = ['label' => 'Contravvenzioni', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contravvenzione-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
                'attribute' => 'amount',
                'value' => Utils::formatCurrency($model->amount)
            ],
            'articolo_codice',
            'data_accertamento:datetime',
            'targa',
            'punti_patente',
            'payed',
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
