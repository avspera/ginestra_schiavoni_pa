<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = $model->id . " del " .  Utils::formatDate($model->created_at);
$this->params['breadcrumbs'][] = [
    'label' => 'Parcheggio residenti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];
?>
<div class="parcheggio-residenti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>

        <?php if ($model->stato_richiesta == Utils::getStatoRichiestaFlipped("in_lavorazione")) { ?>
            <?= Html::a('Approva', ['change-status', 'id' => $model->id, "new_status" => Utils::getStatoRichiestaFlipped("approvata")], ['class' => 'btn btn-xs btn-success', 'data' => [
                'confirm' => 'Sei sicuro di voler approvare questa richiesta?',
                'method' => 'post',
            ],]) ?>

            <?= Html::a('Respingi', ['change-status', 'id' => $model->id, "new_status" => Utils::getStatoRichiestaFlipped("respinta")], ['class' => 'btn btn-xs btn-warning', 'data' => [
                'confirm' => 'Sei sicuro di voler respingere questa richiesta?',
                'method' => 'post',
            ],]) ?>
        <?php } ?>

        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingRichiesta">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRichiesta" aria-expanded="true" aria-controls="collapseRichiesta">
                    Dettaglio Richiesta
                </button>
            </h2>
            <div id="collapseRichiesta" class="accordion-collapse collapse show" aria-labelledby="headingRichiesta" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'data_richiesta:date',
                            [
                                'attribute' => 'stato_richiesta',
                                'value' => function ($model) {
                                    if ($model->stato_richiesta == Utils::getStatoRichiestaFlipped('in_lavorazione')) {
                                        $class = "btn-success";
                                    }

                                    if ($model->stato_richiesta == Utils::getStatoRichiestaFlipped('da_completare')) {
                                        $class = 'btn-warning'; // Aggiungi la classe 'bg-green' alle righe corrispondenti
                                    }

                                    return "<button class='btn $class'>" . Utils::getStatoRichiesta($model->stato_richiesta) . "</button>";
                                },
                                'format' => "raw"
                            ],
                            [
                                'attribute' => 'id_cittadino',
                                'value' => function ($model) {
                                    if (is_numeric($model->id_cittadino)) {
                                        return Utils::getCittadino($model->id_cittadino);
                                    } else {
                                        return $model->id_cittadino;
                                    }
                                }
                            ],
                            [
                                'attribute' => 'veicolo',
                                'value' => function ($model) {
                                    $veicolo = $model->getVeicolo();
                                    return !empty($veicolo) ? $veicolo->marca . " " . $veicolo->modello : "-";
                                }
                            ],
                            [
                                'attribute' => 'durata',
                                'value' => function ($model) {
                                    return $model->getDurata();
                                }
                            ],
                            'data_rilascio:date',
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
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Richiedente
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?= DetailView::widget([
                        'model' => $cittadino,
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
                                'value' => strtoupper($cittadino->codice_fiscale)
                            ],
                            [
                                'attribute' => 'stato_civile',
                                'value' => $cittadino->getStatoCivile()
                            ],
                            'data_di_nascita:date',
                            'luogo_di_nascita',
                            [
                                'attribute' => "patente_di_guida",
                                'value' => function ($model) {
                                    return Utils::printAttachments($model, "patente_di_guida");
                                },
                                'format' => "raw"
                            ],
                            [
                                'attribute' => 'tipo_documento',
                                'value' => $cittadino->getTipoDocumento()
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
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Veicolo
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?= DetailView::widget([
                        'model' => $veicolo,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'tipo_veicolo',
                                'value' => $veicolo->getTipoVeicolo(),
                            ],
                            'marca',
                            'modello',
                            'targa',
                            [
                                'attribute' => 'tipo_relazione',
                                'value' => $veicolo->getTipoRelazione(),
                            ],
                            [
                                'attribute' => "allegato_1",
                                'value' => function ($model) {
                                    return Utils::printAttachments($model, "allegato_1");
                                },
                                'format' => "raw"
                            ],
                            [
                                'attribute' => "allegato_2",
                                'value' => function ($model) {
                                    return Utils::printAttachments($model, "allegato_2");
                                },
                                'format' => "raw"
                            ],
                            'created_at:datetime'
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>