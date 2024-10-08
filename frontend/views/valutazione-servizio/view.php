<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\ValutazioneServizio $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Valutazione Servizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valutazione-servizio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id_cittadino',
            'nome_servizio',
            'overall_rating',
            'satisfaction_reason',
            'angry_reason',
            'notes:ntext',
        ],
    ]) ?>

</div>
