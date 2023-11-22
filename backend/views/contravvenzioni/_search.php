<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ContravvenzioneSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg card-big no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <div class="mb-4">
                    <div class="float-start col-md-6 mb-0 mb-md-5">
                        <span class="card-title h4">Cerca</span>
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="form-group col-md-2 col-xs-12">
                        <?= $form->field($model, 'id')->label("ID", ["class" => "control-label active"]) ?>
                    </div>

                    <div class="form-group col-md-2 col-xs-12">
                        <?= $form->field($model, 'amount')->label("Importo", ["class" => "control-label active"]) ?>
                    </div>

                    <div class="form-group col-md-2 col-xs-12">
                        <?= $form->field($model, 'articolo_codice')->label("Articolo codice", ["class" => "control-label active"]) ?>
                    </div>

                    <div class="form-group col-md-3 col-xs-12">
                        <?= $form->field($model, 'targa')->label("Targa", ["class" => "control-label active"]) ?>
                    </div>

                    <div class="form-group col-md-3 col-xs-12">
                        <?= $form->field($model, 'data_accertamento')->textInput(["type" => "date", "max" => date("Y-m-d")])->label("Data di accertamento", ["class" => "control-label active"]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?>
                    <?= Html::a('Annulla', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>