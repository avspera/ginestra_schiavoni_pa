<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */

$this->title = $model->numero_atto . " del " . Yii::$app->formatter->asDate($model->created_at);
$this->params['breadcrumbs'][] = [
    'label' => 'Albo pretorio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];

?>
<div class="albo-pretorio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'numero_atto',
            'progressivo',
            'anno',
            'oggetto',
            [
                'attribute' => 'id_tipologia',
                'value' => function ($model) {
                    $tipologia = $model->getTipologia($model->id_tipologia);

                    return isset($tipologia["descrizioneDocumento"]) ? $tipologia["descrizioneDocumento"] : "-";
                }
            ],
            'numero_affissione',
            'data_pubblicazione:date',
            'created_at:date',
            'created_by',
            'updated_by',
            'eliminato_da',
            'data_eliminazione:date',
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
            'note:ntext',
        ],
    ]) ?>

</div>