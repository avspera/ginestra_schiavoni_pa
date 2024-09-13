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
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
                    'data_richiesta',
                    'stato_richiesta',
                    'data_risposta',
                    'note:ntext',
                    'documento_rilasciato',
                    'data_creazione',
                    'data_aggiornamento',
                ],
            ]) ?>
        </div>
    </div>
</div>