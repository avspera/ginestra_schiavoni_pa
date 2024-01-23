<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = $model->oggetto;
$this->params['breadcrumbs'][] = [
    'label' => 'Atti di Matrimonio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];

\yii\web\YiiAsset::register($this);
?>
<div class="atto-di-matrimonio-view">

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
            'created_at:date',
            'updated_at:datetime',
        ],
    ]) ?>

</div>