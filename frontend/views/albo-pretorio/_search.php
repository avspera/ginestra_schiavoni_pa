<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\Utils;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorioSearch $model */
/** @var yii\widgets\ActiveForm $form */
$anni_list = Utils::getListaAnni();

?>

<div class="albo-pretorio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg card-big no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <div class="mb-4">
                    <div class="float-start col-md-6 mb-0 mb-md-5">
                        <span class="card-title h4">Cerca nell'Albo Pretorio</span>
                    </div>
                    <div class="float-end col-md-6 mb-5 mb-md-0 text-start text-md-end">
                        <span class="data">
                            <span class="dataagg">Ultimo aggiornamento: 21/11/2023</span>
                        </span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div>
                    <div class="row">
                        <div class="form-group d-inline-flex col-md-3">
                            <div class="form-control select-wrapper p-0">
                                <label for="id_tipologia">Tipologia</label>
                                <select id="albopretorio-id_tipologia" name="AlboPretorio[id_tipologia]">
                                    <option value="">Tutti</option>
                                    <?php foreach ($model->tipologia_choices as $key => $value) { ?>
                                        <option value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-inline-flex col-md-3">
                            <div class="form-control select-wrapper p-0">
                                <label for="anno">Anno</label>
                                <select id="albopretorio-anno" name="AlboPretorio[anno]">
                                    <option value="">Tutti</option>
                                    <?php foreach ($anni_list as $item) { ?>
                                        <option value="<?= $item ?>"><?= $item ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-inline-flex col-md-6">
                            <label for="notes" class="">Oggetto</label>
                            <input name="AlboPretorio[note]" type="text" id="albopretorio-note" title="Cerca una parola all'interno dell'oggetto" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group d-inline-flex col-md-3">
                            <?= $form->field($model, "numero_affissione")->textInput(); ?>
                        </div>
                        <div class="form-group d-inline-flex col-md-3">
                            <?= $form->field($model, "numero_atto")->textInput(); ?>
                        </div>

                        <div class="form-group d-inline-flex col-md-3">
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

                    </div>
                </div>

                <div class="float-start col-md-6">
                    <div class="form-group">
                        <?= Html::submitButton('Cerca', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Annulla', Url::to(["index"]), ['class' => 'btn btn-outline-secondary']) ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>