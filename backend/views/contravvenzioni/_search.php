<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ContravvenzioneSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'articolo_codice') ?>

    <?= $form->field($model, 'data_accertamento') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'targa') ?>

    <?php // echo $form->field($model, 'punti_patente') ?>

    <?php // echo $form->field($model, 'payed') ?>

    <?php // echo $form->field($model, 'data_pagamento') ?>

    <?php // echo $form->field($model, 'ricevuta_pagamento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
