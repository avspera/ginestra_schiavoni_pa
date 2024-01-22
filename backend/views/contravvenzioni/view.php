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

    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Dati contravvenzione</h3>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'id_univoco_versamento',
                            'stato',
                            [
                                'attribute' => 'strumento',
                                'value' => function ($model) {
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
                                    $msg = $model->payed ? "SI" : "NO";
                                    $color = $model->payed ? "green" : "red";
                                    return "<span style='color:$color'>$msg</span>";
                                },
                                'format' => "raw"
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Dati pagatore</h3>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => "tipo_persona",
                                'value' => function ($model) {
                                    return $model->getTipoPersona();
                                }
                            ],
                            'nome',
                            'cognome',
                            'email',
                            'cf',
                            'via',
                            'civico',
                            'cap',
                            'comune',
                            'prov',
                            'nazione'
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>