<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cittadino-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'data_di_nascita')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Seleziona data di nascita'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'endDate' => "0d",
                    'format' => "dd-mm-yyyy",
                    'orientation' => 'bottom'
                ],
                'pluginEvents' => [
                    'changeDate' => "function(e){
                        if(e.date.getFullYear()){
                            let year    = e.date.getFullYear();
                            let currentYear = new Date().getFullYear();
                            let eta     = currentYear - year;
                            $('#cittadino-eta').val(eta);
                        }
                    }"
                ]
            ]); ?>
        </div>
        <div class="col-md-3"><?= $form->field($model, 'comune_di_nascita')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'tipo_documento')->dropDownList($model->tipo_documento_choices, ['prompt' => "Scegli"]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'documento_di_identita')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'professione')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'eta')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'stato_civile')->dropDownList($model->stato_civile_choices, ["prompt" => "Scegli"]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'comune_di_residenza')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'indirizzo_di_residenza')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'cittadinanza')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'codice_fiscale')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>