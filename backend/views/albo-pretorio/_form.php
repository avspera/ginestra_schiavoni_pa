<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="albo-pretorio-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <span class="visually-hidden">Categoria:</span>
        <div class="card-header border-0 p-0">
        </div>
        <div class="card-body p-0 my-2">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="albopretorio-titolo">Titolo</label>
                        <input type="text" name="AlboPretorio[titolo]" id="albopretorio-titolo" value="<?= $model->titolo ?>" class="form-control" id="exampleInputText">
                    </div>
                </div>
                <div class="col-lg-2"><?= $form->field($model, 'numero_atto')->textInput() ?></div>
                <div class="col-lg-2"><?= $form->field($model, 'numero_affissione')->textInput() ?></div>

            </div>
            <div class="row">
                <div class="form-group d-inline-flex col-md-3 col-xs-12">
                    <div class="form-control select-wrapper p-0">
                        <label for="sorgente">Sorgente</label>
                        <select class="select-italia" id="albopretorio-sorgente" name="AlboPretorio[sorgente]">
                            <option value="">Tutti</option>
                            <?php foreach ($model->sorgente_choices as $key => $value) { ?>
                                <option <?= $model->sorgente == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group d-inline-flex">
                        <div class="form-control select-wrapper p-0">
                            <label for="id_tipologia">Tipologia</label>
                            <select class="select-italia" id="albopretorio-id_tipologia" name="AlboPretorio[id_tipologia]">
                                <option value="">Tutti</option>
                                <?php foreach ($model->tipologia_choices as $key => $value) { ?>
                                    <option <?= $model->id_tipologia == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group field-albopretorio-anno">
                        <label class="control-label" for="albopretorio-anno">Anno</label>
                        <input type="text" value="<?= $model->anno ?>" id="albopretorio-anno" class="form-control" name="AlboPretorio[anno]" data-focus-mouse="false">
                    </div>
                </div>

            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <div class="form-group field-albopretorio-data_pubblicazione">
                        <label class="active" for="dateStandard">Data pubblicazione</label>
                        <input value="<?= date("Y-m-d", strtotime($model->data_pubblicazione)) ?>" type="date" id="albopretorio-data_pubblicazione" max="<?= date("Y-m-d") ?>" name="AlboPretorio[data_pubblicazione]">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group field-albopretorio-data_fine_pubblicazione">
                        <label class="active" for="dateStandard">Data fine pubblicazione</label>
                        <input value="<?= date("Y-m-d", strtotime($model->data_fine_pubblicazione)) ?>" type="date" id="albopretorio-data_fine_pubblicazione" name="AlboPretorio[data_fine_pubblicazione]">
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="albopretorio-note">Note</label>
                        <textarea id="albopretorio-note" name="AlboPretorio[note]" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <?php
            if (!empty($model->attachments)) {
                $attachments = json_decode($model->attachments, true);
                foreach ($attachments as $item) {
                    $fileUrl = Yii::getAlias("@web") . "/uploads/albo-pretorio/" . $item;
                    $icon = substr($item, strrpos($item, ".")) == ".pdf" ? "it-file-pdf" : "it-file";

            ?>
                    <svg class="icon" aria-hidden="true">
                        <use href="/bootstrap-italia/svg/sprites.svg#<?= $icon ?>"></use>
                    </svg>
                    <a target="_blank" class="pdf" title="Clicca per aprire il documento (formato PDF)" href="<?= Url::to($fileUrl) ?>"><?= $item ?><span class="fw-normal ms-2">( 233,69 Kb )</span></a>
                    <?= Html::a('<svg class="icon icon-danger icon-sm" aria-hidden="true">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-delete"></use>
                    </svg>', ['delete-attachment', 'item' => $item, "id" => $model->id], [
                        
                        'data' => [
                            'confirm'   => 'Sei sicuro di voler cancellare questo elemento?',
                            'method'    => 'post',
                        ],
                    ]) ?>
                    <br />
                <?php }
            } else { ?>
                <small class="text-sm">Nessun allegato disponibile</small>
            <?php } ?>

            <div class="row mt-2">
                <div class="col-12">
                    <label for="AlboPretorio[attachments]">
                        Carica allegati (.jpg, .png., .pdf)
                    </label>
                    <input accept="image/*,.pdf" type="file" name="AlboPretorio[attachments][]" id="albopretorio-attachments" multiple="multiple" />
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