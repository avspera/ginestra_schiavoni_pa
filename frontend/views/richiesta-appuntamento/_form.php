<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RichiestaAppuntamento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="richiesta-appuntamento-form" style="margin-top: 30px;">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-12 col-md-4"><?= $form->field($model, 'nome_richiedente')->textInput(['maxlength' => true])->label("Nome richiedente", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'cognome_richiedente')->textInput(['maxlength' => true])->label("Congome richiedente", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'email_richiedente')->textInput(['maxlength' => true, "type" => "email"])->label("Email richiedente", ["class" => "active control-label"]) ?></div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4"><?= $form->field($model, 'data')->textInput(['maxlength' => true, "type" => "date"])->label("Data", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4">
            <div class="select-wrapper">
                <?= $form->field($model, 'sede_riferimento')->dropDownList($model->sede_riferimento_choices, ['prompt' => "Scegli"])->label("Sede di riferimento", ["class" => "active control-label"]) ?>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label class="active control-label" for="exampleFormControlTextarea1">Note</label>
                <textarea id="richiestaappuntamento-note" name="RichiestaAppuntamento[note]" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <label class="control-label active" for="RichiestaAppuntamento[attachments]">
                Carica allegati (.jpg, .png., .pdf)
            </label>
            <input accept="image/*,.pdf" type="file" name="RichiestaAppuntamento[attachments][]" id="richiestaappuntamento-attachments" multiple="multiple" />
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>