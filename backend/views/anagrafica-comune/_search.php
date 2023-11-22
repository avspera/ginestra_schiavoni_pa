<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AnagraficaComuneSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="anagrafica-comune-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'pec') ?>

    <?= $form->field($model, 'centralino') ?>

    <?= $form->field($model, 'via') ?>

    <?php // echo $form->field($model, 'civico') ?>

    <?php // echo $form->field($model, 'comune') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'responsabile_gestione_telematica') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
