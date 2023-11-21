<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Albo Pretorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="albo-pretorio-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'numero_atto',
            'anno',
            'id_tipologia',
            'id_settore',
            'numero_affissione',
            'data_pubblicazione',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'attachments:ntext',
            'note:ntext',
        ],
    ]) ?>

</div>
