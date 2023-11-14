<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

$this->title = $model->nome . " " . $model->cognome;
$this->params['breadcrumbs'][] = ['label' => 'Cittadini', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cittadino-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card card-info">
        <div class="card-header">
            <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
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
        </div>
    </div>
</div>