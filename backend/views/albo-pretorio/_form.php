<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="albo-pretorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <span class="visually-hidden">Categoria:</span>
        <div class="card-header border-0 p-0">
        </div>
        <div class="card-body p-0 my-2">
            <div class="row">
                <div class="col-lg-6"><?= $form->field($model, 'titolo')->textInput() ?></div>

            </div>
            <div class="row">
                <div class="col-lg-2"><?= $form->field($model, 'numero_atto')->textInput() ?></div>
                <div class="col-lg-2"><?= $form->field($model, 'numero_affissione')->textInput() ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'id_tipologia')->dropDownList($model->tipologia_choices, ["prompt" => "Scegli"]) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'id_settore')->dropDownList($model->settore_choices, ["prompt" => "Scegli"]) ?></div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-2"><?= $form->field($model, 'anno')->textInput(["value" => date("Y")]) ?></div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'data_pubblicazione')->widget(DatePicker::classname(), [
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'endDate' => "0d",
                            'format' => "dd-mm-yyyy",
                            'orientation' => 'bottom'
                        ],
                    ]); ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'data_fine_pubblicazione')->widget(DatePicker::classname(), [
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

            <div class="row mt-2">
                <div class="col-12">
                    <?= $form->field($model, 'attachments')->textarea(['rows' => 6]) ?>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>

        <div>
            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-success float-end']) ?>
            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>