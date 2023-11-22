<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AnagraficaComune $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="anagrafica-comune-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <div class="card-body p-0 my-2">
            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true, "type" => "email"])->label("Email", ["class" => "active control-label"]) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <?= $form->field($model, 'pec')->textInput(['maxlength' => true, "type" => "email"])->label("PEC", ["class" => "active control-label"]) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <?= $form->field($model, 'centralino')->textInput(['maxlength' => true])->label("Centralino", ["class" => "active control-label"]) ?>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="form-group">
                        <?= $form->field($model, 'via')->textInput(['maxlength' => true])->label("Via", ["class" => "active control-label"]) ?>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <?= $form->field($model, 'civico')->textInput(['maxlength' => true])->label("Civico", ["class" => "active control-label"]) ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <?= $form->field($model, 'comune')->textInput(['maxlength' => true])->label("Comune", ["class" => "active control-label"]) ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <?= $form->field($model, 'provincia')->textInput(['maxlength' => true])->label("Provincia", ["class" => "active control-label"]) ?>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <?= $form->field($model, 'responsabile_gestione_telematica')->textInput(['maxlength' => true])->label("Nome del responsabile della gestione telematica", ["class" => "active control-label"]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>