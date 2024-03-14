<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */
/** @var yii\widgets\ActiveForm $form */
$indirizzo = "";
if (!empty($loggedUser["attributes"])) {
    $indirizzo .= $loggedUser["attributes"]["spid_address"] . ", " . $loggedUser["attributes"]["spid_postal_code"] . " - " . $loggedUser["attributes"]["spid_city"];
}
?>

<div class="parcheggio-residenti-form mt-5">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="active control-label" for="parcheggioresidenti-cittadino">Nome</label>
            <input type="text" name="ParcheggioResidenti[cittadino]" id="parcheggioresidenti-cittadino" value="<?= !empty($loggedUser["name"]) ? $loggedUser["name"] : $model->cittadino ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="parcheggioresidenti-cf_richiedente">Nome</label>
            <input type="text" name="ParcheggioResidenti[cf_richiedente]" id="parcheggioresidenti-cf_richiedente" value="<?= !empty($loggedUser["fiscal_code"]) ? $loggedUser["fiscal_code"] : $model->cf_richiedente ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="parcheggioresidenti-indirizzo">Indirizzo</label>
            <input type="text" name="ParcheggioResidenti[indirizzo]" id="parcheggioresidenti-indirizzo" value="<?= !empty($indirizzo) ? $indirizzo : $model->indirizzo ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label class="active control-label" for="parcheggioresidenti-qnt_auto">N. auto</label>
            <input type="text" name="ParcheggioResidenti[qnt_auto]" id="parcheggioresidenti-qnt_auto" value="<?= $model->qnt_auto ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="parcheggioresidenti-targa">Targa (separate da virgola se più di una)</label>
            <input type="text" name="ParcheggioResidenti[targa]" id="parcheggioresidenti-targa" value="<?= $model->targa ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="active control-label" for="parcheggioresidenti-veicolo">Modello Veicolo (separati da virgola se più di uno)</label>
            <input type="text" name="ParcheggioResidenti[veicolo]" id="parcheggioresidenti-veicolo" value="<?= $model->targa ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <div class="select-wrapper">
                <label class="active control-label" for="user-status">Durata</label>
                <select id="parcheggio-residenti-durata" name="ParcheggioResidenti[durata]">
                    <option selected="" value="">Scegli un'opzione</option>
                    <?php foreach ($model->durata_choices as $key => $value) { ?>
                        <option <?= $model->durata == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

    </div>

    <label>Carta di identità</label>
    <?php
    if (!empty($model->carta_identita)) {
        $attachments = json_decode($model->carta_identita, true);
        //$attachments = $model->carta_identita;
        foreach ($attachments as $item) {
            $fileUrl = Yii::getAlias("@web") . "/uploads/parcheggio-residenti/" . $item;
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
            <label class="control-label active" for="ParcheggioResidenti[carta_identita]">
                Carica carta di identità (.jpg, .png., .pdf)
            </label>
            <input required accept="image/*,.pdf" type="file" name="ParcheggioResidenti[carta_identita][]" id="parcheggio-residenti-carta_identita" multiple="true" />
        </div>
    </div>

    <div class="row mt-2"></div>

    <label class='active'>Carta di circolazione</label>
    <?php
    if (!empty($model->carta_circolazione)) {
        $attachments = json_decode($model->carta_circolazione, true);
        //$attachments = $model->carta_circolazione;
        foreach ($attachments as $item) {
            $fileUrl = Yii::getAlias("@web") . "/uploads/parcheggio-residenti/" . $item;
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
            <label class="control-label active" for="ParcheggioResidenti[carta_circolazione]">
                Carica allegati (.jpg, .png., .pdf)
            </label>
            <input required accept="image/*,.pdf" type="file" name="ParcheggioResidenti[carta_circolazione][]" id="parcheggio-residenti-carta_circolazione" multiple="multiple" />
        </div>
    </div>

    <div class="row mt-2">
        <h3 class="text-center heading-3 heading-3-lg">DICHIARA</h3>
        <ul data-element="all-topics">
            <li>Di essere a conoscenza che li spazi individuati, da adibire al parcheggio, non consentono l’assegnazione individuale di uno stallo per autovetture, ciclomotori o motocicli pertanto l’utente potrà parcheggiare in uno spazio qualsiasi dell’area assegnata fino all’esaurimento dei posti.</li>
            <li>Di essere a conoscenza che nelle sopra indicate aree riservate quali parcheggi non è previsto il servizio di vigilanza o custodia del veicolo di conseguenza l’Amministrazione Comunale non risponderà di eventuali danni cagionati da terzi per furti, effrazioni o sottrazioni, ivi compresi eventuali oggetti lasciati a bordo, accessori e/o singole parti del veicolo.</li>
        </ul>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>