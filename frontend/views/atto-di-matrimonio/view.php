<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Atto Di Matrimonios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="atto-di-matrimonio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_coniuge_uno',
            'id_coniuge_due',
            'data_matrimonio',
            'id_residenza',
            'padre_coniuge_uno',
            'madre_coniuge_uno',
            'padre_coniuge_due',
            'madre_coniuge_due',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'tipo_rito',
            'luogo_matrimonio',
            'regime_matrimoniale',
            'titolo_studio_coniuge_uno',
            'titolo_studio_coniuge_due',
            'posizione_professionale_coniuge_uno',
            'posizione_professionale_coniuge_due',
            'condizione_non_professionale_coniuge_uno',
            'condizione_non_professionale_coniuge_due',
        ],
    ]) ?>

</div>
