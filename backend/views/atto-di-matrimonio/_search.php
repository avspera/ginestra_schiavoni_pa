<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-search">

    <div class="card card-info">
        <div class="card-header">
            Cerca
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>

            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'id') ?>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    <?= $form->field($model, 'id_coniuge_uno')->widget(Select2::classname(), [
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
                        'pluginEvents' => [
                            "select2:select" => "function(item) { getQuotes(item.params.data.id)}",
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-3 col-sm-4 col-12">
                    <?= $form->field($model, 'id_coniuge_due')->widget(Select2::classname(), [
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
                        'pluginEvents' => [
                            "select2:select" => "function(item) { getQuotes(item.params.data.id)}",
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'data_matrimonio')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Seleziona data di nascita'],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'endDate' => "0d",
                            'format' => "dd-mm-yyyy",
                            'orientation' => 'bottom'
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'created_at')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => 'Seleziona data'],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'endDate' => "0d",
                            'format' => "dd-mm-yyyy",
                            'orientation' => 'bottom'
                        ],
                    ]); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'tipo_rito')->dropDownList($model->tipo_rito_choices, ["prompt" => "Scegli"]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'regime_matrimoniale')->dropDownList($model->regime_matrimoniale_choices, ["prompt" => "Scegli"]) ?>
                </div>
            </div>

            <div class="row" style="margin-top:10px;">
                <div class="col-md-12">
                    <div class="form-group float-end">
                        <?= Html::submitButton('Cerca', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancella Filtri', Url::to(["index"]), ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>