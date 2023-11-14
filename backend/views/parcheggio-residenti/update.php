<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = 'Update Parcheggio Residenti: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Parcheggio Residentis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parcheggio-residenti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
