<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RichiestaAppuntamentoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="richiesta-appuntamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email_richiedente') ?>

    <?= $form->field($model, 'nome_richiedente') ?>

    <?= $form->field($model, 'cognome_richiedente') ?>

    <?= $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'sede_riferimento') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'attachments') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
