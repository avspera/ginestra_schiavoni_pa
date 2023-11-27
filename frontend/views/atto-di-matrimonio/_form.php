<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-12">
        <!--start card-->
        <div class="card-wrapper">
            <div class="card">
                <div class="card-body">
                    <div class="categoryicon-top">
                        <svg class="icon">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-user"></use>
                        </svg>
                        <span class="text">Coniuge uno</span>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-4"><?= $form->field($model, 'coniuge_uno')->textInput()->label("Nome e cognome", ["class" => "active control-label"]) ?></div>
                        <div class="col-12 col-md-4"><?= $form->field($model, 'padre_coniuge_uno')->textInput(['maxlength' => true])->label("Padre", ["class" => "active control-label"]) ?></div>
                        <div class="col-12 col-md-4"><?= $form->field($model, 'madre_coniuge_uno')->textInput(['maxlength' => true])->label("Madre", ["class" => "active control-label"]) ?></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'titolo_studio_coniuge_uno')->dropdownlist($model->titolo_studio_choices, ["prompt" => "Scegli"])->label("Titolo di studio", ["class" => "active control-label"]) ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'posizione_professionale_coniuge_uno')->dropdownlist($model->posizione_professionale_choices, ["prompt" => "Scegli"])->label("Posizione professionale", ["class" => "active control-label"]) ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'condizione_non_professionale_coniuge_uno')->dropdownlist($model->condizione_non_professionale_choices, ["prompt" => "Scegli"])->label("Condizione non professionale", ["class" => "active control-label"]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="categoryicon-top">
                        <svg class="icon">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-user"></use>
                        </svg>
                        <span class="text">Coniuge due</span>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-4"><?= $form->field($model, 'coniuge_due')->textInput()->label("Nome e cognome", ["class" => "active control-label"]) ?></div>
                        <div class="col-12 col-md-4"><?= $form->field($model, 'padre_coniuge_due')->textInput(['maxlength' => true])->label("Padre", ["class" => "active control-label"]) ?></div>
                        <div class="col-12 col-md-4"><?= $form->field($model, 'madre_coniuge_due')->textInput(['maxlength' => true])->label("Madre", ["class" => "active control-label"]) ?></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'titolo_studio_coniuge_due')->dropdownlist($model->titolo_studio_choices, ["prompt" => "Scegli"])->label("Titolo di studio", ["class" => "active control-label"]) ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'posizione_professionale_coniuge_due')->dropdownlist($model->posizione_professionale_choices, ["prompt" => "Scegli"])->label("Posizione professionale", ["class" => "active control-label"]) ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'condizione_non_professionale_coniuge_due')->dropdownlist($model->condizione_non_professionale_choices, ["prompt" => "Scegli"])->label("Condizione non professionale", ["class" => "active control-label"]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="categoryicon-top">
                        <svg class="icon">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-list"></use>
                        </svg>
                        <span class="text">Matrimonio</span>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-4"><?= $form->field($model, 'data_matrimonio')->textInput(["type" => "date"])->label("Data", ["class" => "active control-label"]) ?></div>
                        <div class="col-12 col-md-4"><?= $form->field($model, 'residenza')->textInput(['maxlength' => true])->label("Residenza", ["class" => "active control-label"]) ?></div>
                        <div class="col-12 col-md-4"><?= $form->field($model, 'luogo_matrimonio')->textInput(['maxlength' => true])->label("Luogo", ["class" => "active control-label"]) ?></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-md-6">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'tipo_rito')->dropDownList($model->tipo_rito_choices, ["prompt" => "Scegli"])->label("Tipo di rito", ["class" => "active control-label"]) ?></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="select-wrapper">
                                <?= $form->field($model, 'regime_matrimoniale')->dropDownList($model->regime_matrimoniale_choices, ['prompt' => "Scegli"])->label("Regime matrimoniale", ["class" => "active control-label"]) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>