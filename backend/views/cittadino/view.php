<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

$this->title = $model->nome . " " . $model->cognome;
$this->params['breadcrumbs'][] = [
    'label' => 'Cittadini',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];
?>
<div class="cittadino-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'spid_reference',
            'nome',
            'cognome',
            'email:email',
            'telefono',
            'professione',
            'eta',
            [
                'attribute' => 'codice_fiscale',
                'value' => strtoupper($model->codice_fiscale)
            ],
            [
                'attribute' => 'stato_civile',
                'value' => function ($model) {
                    return $model->getStatoCivile();
                }
            ],
            'data_di_nascita:date',
            'comune_di_nascita',
            'documento_di_identita',
            [
                'attribute' => 'tipo_documento',
                'value' => function ($model) {
                    return $model->getTipoDocumento();
                }
            ],
            'comune_di_residenza',
            'indirizzo_di_residenza',
            'cittadinanza',
            'created_at:datetime',
            'updated_at:datetime',
            'last_login:datetime',
        ],
    ]) ?>

</div>