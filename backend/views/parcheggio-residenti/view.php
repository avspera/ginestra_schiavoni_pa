<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = $model->id." di ".Utils::getCittadino($model->id_cittadino);
$this->params['breadcrumbs'][] = ['label' => 'Parcheggio Residenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="parcheggio-residenti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
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
            [
                'attribute' => 'id_cittadino',
                'value' => function($model){
                    return Utils::getCittadino($model->id_cittadino);
                }
            ],
            'id_indirizzo',
            'qnt_auto',
            [
                'attribute' => 'price',
                'value' => function($model){
                    return Utils::formatCurrency($model->price);
                }
            ],
            [
                'attribute' => 'payed',
                'value' => $model->payed ? "SI" : "NO"
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => Utils::getCreatedBy($model->created_by)
            ],
            'updated_by',
            
        ],
    ]) ?>

</div>
