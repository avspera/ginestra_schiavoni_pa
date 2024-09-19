<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */

$this->title = "Nr. " . $model->numero_atto . " del " . Utils::formatDate($model->data_pubblicazione);
$this->params['breadcrumbs'][] = [
    'label' => 'Albo pretorio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];
?>
<div class="albo-pretorio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'oggetto',
            'numero_atto',
            'progressivo',
            'numero_affissione',
            'anno',
            'data_pubblicazione:date',
            'data_fine_pubblicazione:date',
            [
                'attribute' => 'id_tipologia',
                'value' => function ($model) {
                    $tipologia = $model->getTipologia($model->id_tipologia);
                    return isset($tipologia["descrizioneDocumento"]) ? $tipologia["descrizioneDocumento"] : "-";
                }
            ],
            'note:ntext',
            [
                'attribute' => 'attachments',
                'value' => function ($model) {
                    $html = "";
                    $decodedAllegati = json_decode($model->attachments);
                    foreach ($decodedAllegati as $allegato) {
                        $icon = substr($allegato->nomeFile, strrpos($allegato->nomeFile, ".")) == ".pdf" ? "it-file-pdf" : "it-file";
                        // $html .= Html::a($allegato->nomeFile, Url::to($allegato->url), ["target" => "_blank"]);
                        $html .= '<svg class="icon" aria-hidden="true">
                                    <use href="/bootstrap-italia/svg/sprites.svg#' . $icon . '"></use>
                                </svg>
                                <a target="_blank" class="pdf" title="Clicca per aprire il documento (formato PDF)" href="' . Url::to($allegato->url) . '">' . $allegato->nomeFile . '</a> <br />';
                    }
                    return $html;
                },
                'format' => "raw"
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return Utils::getCreatedBy($model->created_by);
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return Utils::getCreatedBy($model->created_by);
                }
            ],
        ],
    ]) ?>

    <?php if (!empty($attoDiMatrimonio)) { ?>
        <h1>Atto di matrimonio</h1>
        <?= DetailView::widget([
            'model' => $attoDiMatrimonio,
            'attributes' => [
                'id',
                [
                    'attribute' => "published",
                    'value' => function ($model) {
                        return $model->published ? "SI" : "NO";
                    }
                ],
                [
                    'attribute' => "approved",
                    'value' => function ($model) {
                        return $model->approved ? "SI" : "NO";
                    }
                ],
                [
                    'attribute' => 'coniuge_uno',
                    'value' => function ($model) {
                        if (is_numeric($model->coniuge_uno)) {
                            return Utils::getCittadino($model->coniuge_uno);
                        } else {
                            return $model->coniuge_uno;
                        }
                    },
                    'format' => "raw"
                ],
                'data_matrimonio:date',
                [
                    'attribute' => 'residenza',
                    'value' => function ($model) {
                        if (is_numeric($model->residenza)) {
                            return Utils::getResidenza($model->residenza);
                        } else {
                            return $model->residenza;
                        }
                    },
                    'format' => "raw"
                ],
                'padre_coniuge_uno',
                'madre_coniuge_uno',
                'padre_coniuge_due',
                'madre_coniuge_due',
                'luogo_matrimonio',
                [
                    'attribute' => 'tipo_rito',
                    'value' => function ($model) {
                        return $model->getTipoRito();
                    }
                ],
                [
                    'attribute' => 'regime_matrimoniale',
                    'value' => function ($model) {
                        return $model->getRegimeMatrimoniale();
                    }
                ],
                [
                    'attribute' => 'titolo_studio_coniuge_uno',
                    'value' => function ($model) {
                        return $model->getTitoloStudio($model->titolo_studio_coniuge_uno);
                    }
                ],
                [
                    'attribute' => 'titolo_studio_coniuge_due',
                    'value' => function ($model) {
                        return $model->getTitoloStudio($model->titolo_studio_coniuge_due);
                    }
                ],
                [
                    'attribute' => 'posizione_professionale_coniuge_uno',
                    'value' => function ($model) {
                        return $model->getPosizioneProfessionale($model->posizione_professionale_coniuge_uno);
                    }
                ],
                [
                    'attribute' => 'posizione_professionale_coniuge_due',
                    'value' => function ($model) {
                        return $model->getPosizioneProfessionale($model->posizione_professionale_coniuge_due);
                    }
                ],
                [
                    'attribute' => 'condizione_non_professionale_coniuge_uno',
                    'value' => function ($model) {
                        return $model->getCondizioneNonProfessionale($model->condizione_non_professionale_coniuge_uno);
                    }
                ],
                [
                    'attribute' => 'condizione_non_professionale_coniuge_due',
                    'value' => function ($model) {
                        return $model->getCondizioneNonProfessionale($model->condizione_non_professionale_coniuge_due);
                    }
                ],
                'created_at:datetime',
                'updated_at:datetime',
                [
                    'attribute' => 'updated_by',
                    'value' => function ($model) {
                        return Utils::getCreatedBy($model->updated_by);
                    }
                ],
                [
                    'attribute' => 'approved_by',
                    'value' => function ($model) {
                        return Utils::getCreatedBy($model->approved_by);
                    }
                ],
                [
                    'attribute' => 'published_by',
                    'value' => function ($model) {
                        return Utils::getCreatedBy($model->published_by);
                    }
                ],
            ],
        ]) ?>
    <?php } ?>
</div>