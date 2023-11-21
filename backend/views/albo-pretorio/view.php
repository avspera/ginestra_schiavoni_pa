<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */

$this->title = "Nr. " . $model->numero_atto . " del " . Utils::formatDate($model->data_pubblicazione);
$this->params['breadcrumbs'][] = ['label' => 'Albo Pretorio', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="albo-pretorio-view">

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
            'titolo',
            'numero_atto',
            'numero_affissione',
            'anno',
            'data_pubblicazione:date',
            'data_fine_pubblicazione',
            [
                'attribute' => 'id_tipologia',
                'value' => function ($model) {
                    return $model->getTipologia();
                }
            ],
            [
                'attribute' => 'id_settore',
                'value' => function ($model) {
                    return $model->getSettore();
                }
            ],
            'note:ntext',
            'attachments:ntext',
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

</div>