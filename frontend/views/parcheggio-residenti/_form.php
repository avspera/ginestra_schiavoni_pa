<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parcheggio-residenti-form mt-5">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-12 col-md-4"><?= $form->field($model, 'cittadino')->textInput(['maxlength' => true])->label("Nome richiedente", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'indirizzo')->textInput(['maxlength' => true])->label("Indirizzo", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'qnt_auto')->textInput(['maxlength' => true])->label("N. auto", ["class" => "active control-label"]) ?></div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4"><?= $form->field($model, 'targa')->textInput(['maxlength' => true])->label("Targa (separate da virgola se più di una)", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4"><?= $form->field($model, 'veicolo')->textInput(['maxlength' => true])->label("Modello Veicolo (separati da virgola se più di una)", ["class" => "active control-label"]) ?></div>
        <div class="col-12 col-md-4">
            <div class="select-wrapper">
                <?= $form->field($model, 'durata')->dropDownList($model->durata_choices, ['prompt' => "Scegli"])->label("Durata", ["class" => "active control-label"]) ?>
            </div>
        </div>
    </div>

    <label>Carta di identità</label>
    <?php
    if (!empty($model->carta_identita)) {
        $attachments = json_decode($model->carta_identita, true);
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
            <input accept="image/*,.pdf" type="file" name="ParcheggioResidenti[carta_identita][]" id="parcheggio-residenti-carta_identita" multiple="multiple" />
        </div>
    </div>

    <div class="row mt-2"></div>

    <label class='active'>Carta di circolazione</label>
    <?php
    if (!empty($model->carta_circolazione)) {
        $attachments = json_decode($model->carta_circolazione, true);

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
            <input accept="image/*,.pdf" type="file" name="ParcheggioResidenti[carta_circolazione][]" id="parcheggio-residenti-carta_circolazione" multiple="multiple" />
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