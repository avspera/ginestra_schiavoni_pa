<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SegnalazioneDisservizio $model */

$this->title = 'Update Segnalazione Disservizio: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Segnalazione Disservizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="segnalazione-disservizio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
