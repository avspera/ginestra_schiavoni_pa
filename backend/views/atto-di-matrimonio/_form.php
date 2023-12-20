<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'data_matrimonio')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Seleziona data del matrimonio'],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => "dd-mm-yyyy",
                    'orientation' => 'bottom'
                ],
            ])->label("Data matrimonio", ["class" => "active control-label"]); ?>
        </div>
        <div class="col-md-4"><?= $form->field($model, 'residenza')->textInput()->label("Residenza", ["class" => "active control-label"]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'tipo_rito')->dropDownList($model->tipo_rito_choices, ["prompt" => "Scegli"])->label("Tipo di rito", ["class" => "active control-label"]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'regime_matrimoniale')->dropDownList($model->regime_matrimoniale_choices, ["prompt" => "Scegli"]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'luogo_matrimonio')->textInput(['maxlength' => true])->label("Luogo matrimonio", ["class" => "active control-label"]) ?></div>
    </div>


    <div class="row" style="margin-top:10px;">
        <h3>Coniuge Uno</h3>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <?= $form->field($model, 'coniuge_uno')->widget(Select2::classname(), [
                'options' => [
                    'multiple' => false,
                    'placeholder' => 'Cerca cittadino ...'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(["cittadino/search-from-select"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(client) { return client.text; }'),
                    'templateSelection' => new JsExpression('function (client) { return client.text; }'),
                ],
            ])->label("Nome", ["class" => "control-label active"]);
            ?>
        </div>
        <div class="col-md-4"><?= $form->field($model, 'titolo_studio_coniuge_uno')->dropDownList($model->titolo_studio_choices, ["prompt" => "Scegli"])->label("Titolo di studio", ["class" => "control-label active"])?></div>
        <div class="col-md-4"><?= $form->field($model, 'posizione_professionale_coniuge_uno')->dropDownList($model->posizione_professionale_choices, ["prompt" => "Scegli"])->label("Posizione professionale", ["class" => "control-label active"])?></div>

    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'condizione_non_professionale_coniuge_uno')->dropdownlist($model->condizione_non_professionale_choices, ["prompt" => "Scegli"])->label("Condizione non professionale", ["class" => "control-label active"])?></div>
        <div class="col-md-4"><?= $form->field($model, 'padre_coniuge_uno')->textInput(['maxlength' => true])->label("Padre", ["class" => "control-label active"])?></div>
        <div class="col-md-4"><?= $form->field($model, 'madre_coniuge_uno')->textInput(['maxlength' => true])->label("Madre", ["class" => "control-label active"])?></div>
    </div>

    <div class="row" style="margin-top:10px;">
        <h3>Coniuge Due</h3>
    </div>

    <div class="row mt-2">
        <div class="col-md-4">
            <?= $form->field($model, 'coniuge_due')->widget(Select2::classname(), [
                'options' => [
                    'multiple' => false,
                    'placeholder' => 'Cerca cittadino ...'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to(["cittadino/search-from-select"]),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(client) { return client.text; }'),
                    'templateSelection' => new JsExpression('function (client) { return client.text; }'),
                ],
            ])->label("Nome", ["class" => "control-label active"])
            ?>
        </div>
        <div class="col-md-4"><?= $form->field($model, 'titolo_studio_coniuge_due')->dropDownList($model->titolo_studio_choices, ["prompt" => "Scegli"])->label("Titolo di studio", ["class" => "control-label active"])?></div>
        <div class="col-md-4"><?= $form->field($model, 'posizione_professionale_coniuge_due')->dropDownList($model->posizione_professionale_choices, ["prompt" => "Scegli"])->label("Posizione professionale", ["class" => "control-label active"])?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'condizione_non_professionale_coniuge_due')->dropDownList($model->condizione_non_professionale_choices, ["prompt" => "Scegli"])->label("Condizione non professionale", ["class" => "control-label active"])?></div>
        <div class="col-md-4"><?= $form->field($model, 'padre_coniuge_due')->textInput(['maxlength' => true])->label("Padre", ["class" => "control-label active"])?></div>
        <div class="col-md-4"><?= $form->field($model, 'madre_coniuge_due')->textInput(['maxlength' => true])->label("Madre", ["class" => "control-label active"])?></div>
    </div>

    <div class="row" style="margin-top:10px;">
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>