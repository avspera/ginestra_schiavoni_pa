<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'amount')->textInput() ?></div>
        <div class="col-md-3"><?= $form->field($model, 'articolo_codice')->textInput() ?></div>
        <div class="col-md-3">
            <?= $form->field($model, 'data_accertamento')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Seleziona data'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => "dd-mm-yyyy",
                    'orientation' => 'bottom',
                    'endDate' => "0d",
                ],
            ]); ?>
        </div>
        <div class="col-md-3"><?= $form->field($model, 'targa')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'punti_patente')->textInput() ?></div>
        <div class="col-md-3"><?= $form->field($model, 'payed')->dropdownlist([0 => "NO", 1 => "SI"], ["prompt" => "Scegli"]) ?></div>
        <div class="col-md-3">
            <?= $form->field($model, 'data_pagamento')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Seleziona data'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => "dd-mm-yyyy",
                    'orientation' => 'bottom'
                ],
            ]); ?>
        </div>
        <div class="col-md-3"><?= $form->field($model, 'ricevuta_pagamento')->textInput(['maxlength' => true]) ?></div>
    </div>


    <div class="row" style="margin-top:10px;">
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success float-end']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>