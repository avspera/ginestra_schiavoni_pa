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

    <div class="row mt-3">
        <div class="col-md-4"><?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label("Nome", ["class" => "control-label active"]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'cognome')->textInput(['maxlength' => true])->label("Cognome", ["class" => "control-label active"]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'email')->textInput(['maxlength' => true, "type" => "email"])->label("Email", ["class" => "control-label active"]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'data_di_nascita')->textInput(["type" => "date"])->label("Data di nascita", ["class" => "control-label active"]); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'luogo_di_nascita')->textInput(['maxlength' => true])->label("Comune di nascita", ["class" => "control-label active"]); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'tipo_documento')->dropDownList($model->tipo_documento_choices, ['prompt' => "Scegli"])->label("Tipo di documento", ["class" => "control-label active"]); ?></div>
        <div class="col-md-3"><?= $form->field($model, 'documento_di_identita')->textInput(['maxlength' => true])->label("Numero documento", ["class" => "control-label active"]); ?></div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'professione')->dropDownList($model->posizione_professionale_choices, ['prompt' => "Scegli"])->label("Professione", ["class" => "control-label active"]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'eta')->textInput(['maxlength' => true])->label("Età", ["class" => "control-label active"]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->label("Telefono", ["class" => "control-label active"]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'stato_civile')->dropDownList($model->stato_civile_choices, ["prompt" => "Scegli"])->label("Stato civile", ["class" => "control-label active"]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'comune_di_residenza')->textInput(['maxlength' => true])->label("Comune di residenza", ["class" => "control-label active"]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'indirizzo_di_residenza')->textInput(['maxlength' => true])->label("Indirizzo di residenza", ["class" => "control-label active"]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'cittadinanza')->textInput(['maxlength' => true])->label("Cittadinanza", ["class" => "control-label active"]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'codice_fiscale')->textInput(['maxlength' => true])->label("Codice fiscale", ["class" => "control-label active"]) ?></div>
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