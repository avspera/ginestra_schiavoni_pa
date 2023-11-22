<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Indirizzo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="indirizzo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_cittadino')->textInput() ?>

    <?= $form->field($model, 'id_atto_matrimonio')->textInput() ?>

    <?= $form->field($model, 'via')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'civico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cap')->textInput() ?>

    <?= $form->field($model, 'citta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-xs btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
