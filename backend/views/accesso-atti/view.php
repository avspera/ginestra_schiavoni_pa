<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = $model->id . " del " . Utils::formatDate($model->data_creazione);
$this->params['breadcrumbs'][] = [
    'label' => 'Accesso agli atti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];

?>
<div class="accesso-atto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <?= Yii::t('app', 'Cambio di stato') ?>
        </button>
        <div class="dropdown-menu">
            <?php foreach (Utils::getStatoRichiestaList() as $key => $value) { ?>
                <a class="dropdown-item" href="javascript:;" onclick="changeStatus(<?= $key ?>)"><?= Yii::t('app', $value) ?></a>
            <?php } ?>
        </div>
    </div>
    <?php
    if ($model->type == $model->type_choices_flipped["urgenza"]) {
        if ($model->stato_richiesta == Utils::getStatoRichiestaFlipped("in_lavorazione")) { ?>
            <?= Html::a('Genera pagamento', ['generate-payment', 'id' => $model->id], [
                'class' => 'btn btn-xs btn-success',
                'data' => [
                    'confirm' => 'Sei sicuro di voler generare il pagamento degli oneri di segreteria per questo elemento?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    <?php } ?>

    <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-xs btn-danger',
        'data' => [
            'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
            'method' => 'post',
        ],
    ]) ?>
    </p>

    <div class="row">
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'numero_protocollo',
                    'id_cittadino',
                    'oggetto_richiesta:ntext',
                    'data_richiesta:datetime',
                    [
                        'attribute' => 'stato_richiesta',
                        'value' => function ($model) {
                            return Utils::getStatoRichiesta($model->stato_richiesta);
                        }
                    ],
                    'data_risposta:datetime',
                    'note:ntext',
                    'documento_rilasciato',
                    'data_creazione:datetime',
                    'data_aggiornamento:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>