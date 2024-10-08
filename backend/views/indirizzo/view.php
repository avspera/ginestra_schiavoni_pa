<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Indirizzo $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Indirizzos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indirizzo-view">

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
            'id_atto_matrimonio',
            'via',
            'civico',
            'cap',
            'citta',
            'provincia',
            'type',
        ],
    ]) ?>

</div>
