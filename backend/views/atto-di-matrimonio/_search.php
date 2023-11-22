<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-search">

    <div class="card-wrapper card-space">
        <div class="card card-bg card-big no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                ]); ?>

                <div class="mb-4">
                    <div class="float-start col-md-6 mb-md-5">
                        <span class="card-title h4">Cerca</span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($model, 'id') ?>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group field-atto-di-matrimonio-created_at">
                            <label class="active" for="dateStandard">Coniuge uno</label>
                            <input type="text" id="attodimatrimonio-id_coniuge_uno" name="AttoDiMatrimonio[id_coniuge_uno]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group field-atto-di-matrimonio-created_at">
                            <label class="active" for="dateStandard">Coniuge due</label>
                            <input type="text" id="attodimatrimonio-id_coniuge_uno" name="AttoDiMatrimonio[id_coniuge_uno]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group field-atto-di-matrimonio-data_matrimonio">
                            <label class="active" for="dateStandard">Data matrimonio</label>
                            <input type="date" id="attodimatrimonio-data_pubblicazione" max="<?= date("Y-m-d") ?>" name="AttoDiMatrimonio[data_matrimonio]">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group field-atto-di-matrimonio-created_at">
                            <label class="active" for="dateStandard">Data richiesta</label>
                            <input type="date" id="attodimatrimonio-created_at" max="<?= date("Y-m-d") ?>" name="AttoDiMatrimonio[created_at]">
                        </div>
                    </div>
                    <div class="form-group d-inline-flex col-md-3 col-xs-12">
                        <div class="form-control select-wrapper p-0">
                            <label for="id_tipologia">Tipo di rito</label>
                            <select class="select-italia" id="albopretoriosearch-tipo_rito" name="AlboPretorioSearch[tipo_rito]">
                                <option value="">Tutti</option>
                                <?php foreach ($model->tipo_rito_choices as $key => $value) { ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group d-inline-flex col-md-3 col-xs-12">
                        <div class="form-control select-wrapper p-0">
                            <label for="id_tipologia">Regime matrimoniale</label>
                            <select class="select-italia" id="albopretoriosearch-regime_matrimoniale" name="AlboPretorioSearch[regime_matrimoniale]">
                                <option value="">Tutti</option>
                                <?php foreach ($model->regime_matrimoniale_choices as $key => $value) { ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?>
                            <?= Html::a('Cancella Filtri', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>