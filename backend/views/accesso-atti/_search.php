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

    <div class="card-wrapper">
        <div class="card card-bg  no-after">
            <div class="card-body lightgrey-bg-c1">
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
                    <div class="form-group col-md-4 col-xs-12">
                        <?= $form->field($model, 'numero_protocollo')->label("Protocollo n.", ["class" => "control-label active"]) ?>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <?= $form->field($model, 'id_cittadino')->label("Cittadino", ["class" => "control-label active"]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4 col-xs-12">
                        <?= $form->field($model, 'data_richiesta')->label("Data richiesta", ["class" => "control-label active", "type" => "date"]) ?>
                    </div>
                    <div class="form-group col-md-4 col-xs-12">
                        <?= $form->field($model, 'stato_richiesta')->label("Stato della richiesta", ["class" => "control-label active"]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <?= $form->field($model, "oggetto_richiesta")->label("Oggetto della richiesta", ["class" => "control-label active"])->textarea(["rows" => 4]) ?>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <?= $form->field($model, "note")->label("Note", ["class" => "control-label active"])->textarea(["rows" => 4]) ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?>
                    <?= Html::a('Cancella filtri', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>