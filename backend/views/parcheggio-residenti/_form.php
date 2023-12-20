<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parcheggio-residenti-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="active control-label">Richiedente</label>
                    <div class="select-wrapper">
                        <?= Select2::widget([
                            'model' => $model,
                            'attribute' => "cittadino",
                            'options' => [
                                'multiple' => false,
                                'placeholder' => 'Cerca cittadino ...',
                                'class' => "form-control"
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => Url::to(["cittadino/search-from-select"]),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(client) { return client.text; }'),
                                'templateSelection' => new JsExpression('function (client) { return client.text; }'),
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="active control-label" for="exampleInputText">Indirizzo</label>
                    <input type="text" class="form-control" name="ParcheggioResidenti[indirizzo]" value="<?= $model->indirizzo ?>" id="parcheggio-residenti-indirizzo">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-control select-wrapper p-0">
                    <label class="control-label active" for="payed">Durata</label>
                    <select id="parcheggio-residenti-durata" name="ParcheggioResidenti[durata]">
                        <option value="">Scegli</option>
                        <?php foreach ($model->durata_choices as $key => $value) { ?>
                            <option <?= $model->durata == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4"><?= $form->field($model, 'price')->textInput(["type" => "number", "step" => ".01"])->label("Prezzo", ["class" => "control-label active"]) ?></div>
            <div class="col-md-2">
                <div class="form-control select-wrapper p-0">
                    <label class="control-label active" for="payed">Pagato</label>
                    <select id="parcheggio-residenti-payed" name="ParcheggioResidenti[payed]">
                        <option value="">Scegli</option>
                        <option selected value="0">NO</option>
                        <option value="1">SI</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="active control-label" for="par">Numero auto</label>
                    <input type="number" class="form-control" name="ParcheggioResidenti[qnt_auto]" value="<?= $model->qnt_auto ?>" id="parcheggio-residenti-qnt_auto">
                </div>
            </div>

            <div class="col-md-4"><?= $form->field($model, 'targa')->textInput(["type" => "text", "placeholder" => "Se più di una, separa con la virgola"])->label("Targa", ["class" => "control-label active"]) ?></div>
            <div class="col-md-4"><?= $form->field($model, 'veicolo')->textInput(["type" => "text", "placeholder" => "Se più di uno, separa con la virgola"])->label("Veicolo", ["class" => "control-label active"]) ?></div>

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

        <div class="row" style="margin-top:10px">
            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>