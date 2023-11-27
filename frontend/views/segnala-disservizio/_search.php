<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SegnalazioneDisservizioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="segnalazione-disservizio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_settore') ?>

    <?= $form->field($model, 'luogo') ?>

    <?= $form->field($model, 'note') ?>

    <?= $form->field($model, 'attachments') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'nome_richiedente') ?>

    <?php // echo $form->field($model, 'cognome_richiedente') ?>

    <?php // echo $form->field($model, 'email_richiedente') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
