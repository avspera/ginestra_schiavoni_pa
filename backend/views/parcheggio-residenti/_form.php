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

    <?php $form = ActiveForm::begin(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'id_cittadino')->widget(Select2::classname(), [
                    'options' => [
                        'multiple' => false,
                        'placeholder' => 'Cerca cittadino ...'
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
            <div class="col-md-6"><?= $form->field($model, 'id_indirizzo')->textInput() ?></div>
        </div>

        <div class="row">
            <div class="col-md-4"><?= $form->field($model, 'qnt_auto')->textInput(["type" => "number"]) ?></div>
            <div class="col-md-4"><?= $form->field($model, 'price')->textInput(["type" => "number", "step" => ".01"]) ?></div>
            <div class="col-md-4"><?= $form->field($model, 'payed')->dropDownList([0 => "NO", 1 => "SI"], ["prompt" => "Scegli"]) ?></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?=
                $form->field($model, 'carta_circolazione')->widget(FileInput::classname(), [
                    'options' => [
                        'multiple' => false
                    ],
                    'pluginOptions' => [
                        'initialPreview' => [
                            "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                            "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
                        ],
                        'initialPreviewAsData' => true,
                        'initialCaption' => "The Moon and the Earth",
                        'initialPreviewConfig' => [
                            ['caption' => 'Moon.jpg', 'size' => '873727'],
                            ['caption' => 'Earth.jpg', 'size' => '1287883'],
                        ],
                        'overwriteInitial' => false,
                        'maxFileSize' => 1024,
                        'msgSizeTooLarge' => 'La foto "{name}" (<b>{size} KB</b>) supera il peso consentito.<b> Massimo consentito: {maxSize} KB</b>.',
                    ]
                ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?=
                $form->field($model, 'carta_identita')->widget(FileInput::classname(), [
                    'options' => [
                        'multiple' => false
                    ],
                    'pluginOptions' => [
                        'initialPreview' => [
                            "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                            "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
                        ],
                        'initialPreviewAsData' => true,
                        'initialCaption' => "The Moon and the Earth",
                        'initialPreviewConfig' => [
                            ['caption' => 'Moon.jpg', 'size' => '873727'],
                            ['caption' => 'Earth.jpg', 'size' => '1287883'],
                        ],
                        'overwriteInitial' => false,
                        'maxFileSize' => 1024,
                        'msgSizeTooLarge' => 'La foto "{name}" (<b>{size} KB</b>) supera il peso consentito.<b> Massimo consentito: {maxSize} KB</b>.',
                    ]
                ]);
                ?>
            </div>
        </div>

        <div class="row" style="margin-top:10px">
            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-success float-end']) ?>
            </div>
        </div>

        <div class="row">
            <h3 class="text-center heading-3 heading-3-lg">DICHIARA</h3>
            <ul data-element="all-topics">
                <li>Di essere a conoscenza che li spazi individuati, da adibire al parcheggio, non consentono l’assegnazione individuale di uno stallo per autovetture, ciclomotori o motocicli pertanto l’utente potrà parcheggiare in uno spazio qualsiasi dell’area assegnata fino all’esaurimento dei posti.</li>
                <li>Di essere a conoscenza che nelle sopra indicate aree riservate quali parcheggi non è previsto il servizio di vigilanza o custodia del veicolo di conseguenza l’Amministrazione Comunale non risponderà di eventuali danni cagionati da terzi per furti, effrazioni o sottrazioni, ivi compresi eventuali oggetti lasciati a bordo, accessori e/o singole parti del veicolo.</li>
                </p>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>