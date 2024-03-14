<?php

use common\models\Cittadino;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SegnalazioneDisservizio $model */
/** @var yii\widgets\ActiveForm $form */
$loggedUser = Cittadino::getFakeCittadino();
?>

<div class="segnalazione-disservizio-form" style="margin-top:30px;">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="active control-label" for="segnalazione-disservizio-nome_richiedente">Nome</label>
            <input type="text" name="SegnalazioneDisservizio[nome_richiedente]" id="segnalazione-disservizio-nome_richiedente" value="<?= !empty($loggedUser["name"]) ? $loggedUser["name"] : $model->nome_richiedente ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="segnalazione-disservizio-cf_richiedente">Codice fiscale</label>
            <input type="text" name="SegnalazioneDisservizio[cf_richiedente]" id="segnalazione-disservizio-cf_richiedente" value="<?= !empty($loggedUser["fiscal_code"]) ? $loggedUser["fiscal_code"] : $model->cf_richiedente ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="segnalazione-disservizio-email_richiedente">Email richiedente</label>
            <input type="text" name="SegnalazioneDisservizio[email_richiedente]" id="segnalazione-disservizio-email_richiedente" value="<?= !empty($loggedUser["email"]) ? $loggedUser["email"] : $model->email_richiedente ?>" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="select-wrapper">
                <label class="active control-label" for="segnalazione-disservizio-id_tipologia">Tipologia segnalazione</label>
                <select id="segnalazione-disservizio-id_tipologia" name="SegnalazioneDisservizio[id_tipologia]">
                    <option selected="" value="">Scegli un'opzione</option>
                    <?php foreach ($model->tipologia_choices as $key => $value) { ?>
                        <option <?= $model->id_tipologia == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <label class="active control-label" for="segnalazionedisservizio-note">Note</label>
                <textarea id="segnalazionedisservizio-note" name="SegnalazioneDisservizio[note]" rows="4"></textarea>
            </div>
        </div>
    </div>

    <label class='active'>Allegati</label>
    <?php
    if (!empty($model->attachments)) {
        $attachments = json_decode($model->attachments, true);
        //$attachments = $model->carta_circolazione;
        foreach ($attachments as $item) {
            $fileUrl = Yii::getAlias("@web") . "/uploads/segnala-disservizio/" . $item;
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
            <label class="control-label active" for="SegnalazioneDisservizio[attachments]">
                Carica allegati (.jpg, .png., .pdf)
            </label>
            <input accept="image/*,.pdf" type="file" name="SegnalazioneDisservizio[attachments][]" id="segnalazione-disservizio-attachments" multiple="multiple" />
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>