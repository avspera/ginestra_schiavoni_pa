<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Assistenza $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assistenza-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <div class="card-header border-0 p-0">
        </div>
        <div class="card-body p-0 my-2">
            <div class="row">
                <div class="col-4 col-md-4"><?= $form->field($model, 'nome_richiedente')->textInput(['maxlength' => true])->label("Nome richiedente", ["class" => "active control-label"]) ?></div>
                <div class="col-4 col-md-4"><?= $form->field($model, 'cognome_richiedente')->textInput(['maxlength' => true])->label("Cognome richiedente", ["class" => "active control-label"]) ?></div>
                <div class="col-4 col-md-4"><?= $form->field($model, 'email_richiedente')->textInput(['maxlength' => true, "type" => "email"])->label("Email richiedente", ["class" => "active control-label"]) ?></div>
            </div>

            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="select-wrapper">
                        <?= $form->field($model, 'motivo_richiesta')->dropDownList($model->motivo_richiesta_choices, ['prompt' => "Scegli"])->label("Motivo richiesta", ["class" => "active control-label"]) ?>
                    </div>
                </div>
                <div class="col-4 col-md-4"><?= $form->field($model, 'data_appuntamento')->textInput(['type' => "date"])->label("Data apputamento", ["class" => "active control-label"]) ?></div>
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label class="active control-label" for="exampleFormControlTextarea1">Note</label>
                        <textarea id="assistenza-note" name="Assistenza[note]" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>