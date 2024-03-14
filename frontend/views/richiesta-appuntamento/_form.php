<?php

use common\models\Cittadino;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RichiestaAppuntamento $model */
/** @var yii\widgets\ActiveForm $form */
$loggedUser = Cittadino::getFakeCittadino();
?>

<div class="richiesta-appuntamento-form" style="margin-top: 30px;">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="active control-label" for="richiestaappuntamento-nome_richiedente">Nome</label>
            <input required type="text" name="RichiestaAppuntamento[nome_richiedente]" id="richiestaappuntamento-nome_richiedente" value="<?= !empty($loggedUser["name"]) ? $loggedUser["name"] : $model->nome_richiedente ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="richiestaappuntamento-cf_richiedente">Codice fiscale</label>
            <input required type="text" name="RichiestaAppuntamento[cf_richiedente]" id="richiestaappuntamento-cf_richiedente" value="<?= !empty($loggedUser["fiscal_code"]) ? $loggedUser["fiscal_code"] : $model->cf_richiedente ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="richiestaappuntamento-email_richiedente">Email richiedente</label>
            <input required type="text" name="RichiestaAppuntamento[email_richiedente]" id="richiestaappuntamento-email_richiedente" value="<?= !empty($loggedUser["email"]) ? $loggedUser["email"] : $model->email_richiedente ?>" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="active control-label" for="richiestaappuntamento-data">Data</label>
            <input required type="date" name="RichiestaAppuntamento[data]" id="richiestaappuntamento-data" value="<?= $model->data ?>" class="form-control">
        </div>
        <div class="col-12 col-md-4">
            <div class="select-wrapper">
                <label class="active control-label" for="richiestaappuntamento-sede_riferiemento">Ufficio di riferimento</label>
                <select required id="richiestaappuntamento-id_tipologia" name="RichiestaAppuntamento[sede_riferimento]">
                    <option selected="" value="">Scegli un'opzione</option>
                    <?php foreach ($model->sede_riferimento_choices as $key => $value) { ?>
                        <option <?= $model->sede_riferimento == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label class="active control-label" for="exampleFormControlTextarea1">Note</label>
                <textarea required id="richiestaappuntamento-note" name="RichiestaAppuntamento[note]" rows="3"></textarea>
            </div>
        </div>
    </div>

    <label class='active'>Allegati</label>
    <?php
    if (!empty($model->attachments)) {
        $attachments = json_decode($model->attachments, true);
        //$attachments = $model->carta_circolazione;
        foreach ($attachments as $item) {
            $fileUrl = Yii::getAlias("@web") . "/uploads/richiesta-appuntamento/" . $item;
            $icon = substr($item, strrpos($item, ".")) == ".pdf" ? "it-file-pdf" : "it-file";

    ?>
            <svg class="icon" aria-hidden="true">
                <use href="/bootstrap-italia/svg/sprites.svg#<?= $icon ?>"></use>
            </svg>
            <a target="_blank" class="pdf" title="Clicca per aprire il documento (formato PDF)" href="<?= Url::to($fileUrl) ?>"><?= $item ?></a>
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
            <label class="control-label active" for="RichiestaAppuntamento[attachments]">
                Carica allegati (.jpg, .png., .pdf)
            </label>
            <input accept="image/*,.pdf" type="file" name="RichiestaAppuntamento[attachments][]" id="richiestaappuntamento-attachments" multiple="multiple" />
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>