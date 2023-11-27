<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SegnalazioneDisservizio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="segnalazione-disservizio-form" style="margin-top:30px;">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-12 col-md-4"><?= $form->field($model, 'nome_richiedente')->textInput(['maxlength' => true])->label("Nome richiedente", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'cognome_richiedente')->textInput(['maxlength' => true])->label("Cognome richiedente", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'email_richiedente')->textInput(['maxlength' => true, "type" => "email"])->label("Email richiedente", ["class" => "active control-label"]) ?></div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="select-wrapper">
                <?= $form->field($model, 'id_tipologia')->dropdownlist($model->tipologia_choices, ['prompt' => "Scegli"])->label("Tipologia segnalazione", ["class" => "active control-label"]) ?>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <?= $form->field($model, 'luogo')->textInput()->label("Luogo", ["class" => "active control-label"]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="active control-label" for="segnalazionedisservizio-note">Note</label>
                <textarea id="segnalazionedisservizio-note" name="SegnalazioneDisservizio[note]" rows="4"></textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <label class="control-label active" for="SegnalazioneDisservizio[attachments]">
                Carica allegati (.jpg, .png., .pdf)
            </label>
            <input accept="image/*,.pdf" type="file" name="SegnalazioneDisservizio[attachments][]" id="segnalazionedisservizio-attachments" multiple="multiple" />
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>