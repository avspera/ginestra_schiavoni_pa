<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parcheggio-residenti-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_cittadino')->widget(Select2::classname(), [
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
        <div class="col-md-6"><?= $form->field($model, 'id_indirizzo')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'qnt_auto')->textInput(["type" => "number"]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'price')->textInput(["type" => "number", "step" => ".01"]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'payed')->dropDownList([0 => "NO", 1 => "SI"], ["prompt" => "Scegli"]) ?></div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success float-end']) ?>
        </div>

    </div>


    <?php ActiveForm::end(); ?>

</div>