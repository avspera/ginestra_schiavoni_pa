<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$step = isset($_GET["step"]) ? $_GET["step"] : $model->step;

/** @var yii\web\View $this */
/** @var common\models\AccessoAtti $model */
/** @var ActiveForm $form */

$datiGenerali = isset($steps[1]) ? $steps[1] : [];
if (!empty($datiGenerali)) {
    $datiGenerali = json_decode($datiGenerali["data"], true);
} else {
    $datiGenerali = [];
}

$model->veicolo = isset($datiGenerali["ParcheggioResidenti"]["veicolo"]) ? $datiGenerali["ParcheggioResidenti"]["veicolo"] : NULL;

$datiSpecifici = isset($steps[2]) ? $steps[2] : [];
if (!empty($datiSpecifici)) {
    $datiSpecifici = json_decode($datiSpecifici["data"], true);
} else {
    $datiSpecifici = [];
}

$model->durata = isset($datiSpecifici["ParcheggioResidenti"]["durata"]) ? $datiSpecifici["ParcheggioResidenti"]["durata"] : NULL;

?>
<div class="parcheggio-residenti-form">

    <div class="container">
        <h1 class="title-xxxlarge mb-4">Richiedi Parcheggio per residenti</h1>

        <div class="col-12">
            <div class="steppers">
                <div class="steppers-header">
                    <ul>
                        <li class="<?= $step > 1 ? "confirmed" : "active" ?>">
                            Informativa sulla privacy
                            <?php if ($step == 1) { ?>
                                <span class="visually-hidden">Attivo</span>
                            <?php } else { ?>
                                <svg class="icon steppers-success" aria-hidden="true">
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-check"></use>
                                </svg>
                                <span class="visually-hidden">Confermato</span>
                            <?php } ?>
                        </li>
                        <?php if ($step > 2) {
                            $class = "confirmed";
                        }
                        if ($step == 2) {
                            $class = "active";
                        }

                        if ($step < 2) {
                            $class = "";
                        }

                        ?>
                        <li class="<?= $class ?>">
                            Dati Generali
                            <?php if ($class == "active") { ?>
                                <span class="visually-hidden">Attivo</span>
                            <?php }
                            if ($class == "confirmed") { ?>
                                <svg class="icon steppers-success" aria-hidden="true">
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-check"></use>
                                </svg>
                                <span class="visually-hidden">Confermato</span>
                            <?php } ?>
                        </li>
                        <?php if ($step > 3) {
                            $class = "confirmed";
                        }
                        if ($step == 3) {
                            $class = "active";
                        }

                        if ($step < 3) {
                            $class = "";
                        }
                        ?>
                        <li class="<?= $class ?>">
                            Dati specifici del servizio
                            <?php if ($class == "active") { ?>
                                <span class="visually-hidden">Attivo</span>
                            <?php }
                            if ($class == "confirmed") { ?>
                                <svg class="icon steppers-success" aria-hidden="true">
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-check"></use>
                                </svg>
                                <span class="visually-hidden">Confermato</span>
                            <?php } ?>
                        </li>
                        <?php if ($step > 4) {
                            $class = "confirmed";
                        }
                        if ($step == 4) {
                            $class = "active";
                        }

                        if ($step < 4) {
                            $class = "";
                        }
                        ?>
                        <li class="<?= $class ?>">
                            Riepilogo
                        </li>
                    </ul>
                    <span class="steppers-index" aria-hidden="true"><?= $step ?>/4</span>
                </div>
            </div>
        </div>

        <div class="steppers-content" aria-live="polite">
            <?php
            $form = ActiveForm::begin([
                'id' => "new-parcheggio-residenti",
                'options' => [
                    'class' => ["main-form"],
                ],
                'method' => 'post',
                'action' => Url::to(["parcheggio-residenti/create", "id" => $model->id])
            ]) ?>
            <?= $form->field($model, "id")->hiddenInput()->label(false); ?>
            <?= $form->field($model, "id_cittadino")->hiddenInput()->label(false); ?>
            <?= $form->field($model, "step")->hiddenInput(["value" => $step])->label(false); ?>
            <?= $form->field($model, "stato_richiesta")->hiddenInput()->label(false); ?>
            <?= $form->field($model, "veicolo")->hiddenInput()->label(false) ?>
            <?= $form->field($model, "durata")->hiddenInput()->label(false) ?>
            <?php if ($step == 1) { ?>
                <?= $this->render("/layouts/snippets/servizi/_privacy", ["model" => $model, "step" => $step, "datiPrivacy" => isset($steps[0]) ? $steps[0] : []]) ?>
            <?php } else if ($step == 2) { ?>
                <?= $this->render("/layouts/snippets/servizi/parcheggio-residenti/_dati-generali", ["model" => $model, 'vehicles' => $vehicles, "cittadino" => $cittadino]) ?>
            <?php } else if ($step == 3) { ?>
                <?= $this->render("/layouts/snippets/servizi/parcheggio-residenti/_dati-specifici", ["model" => $model, "form" => $form, "datiSpecifici" => isset($steps[2]) ? $steps[2] : []]) ?>
            <?php } else if ($step == 4) { ?>
                <?= $this->render("/layouts/snippets/servizi/parcheggio-residenti/_riepilogo", ["model" => $model, "cittadino" => $cittadino, "step" => $step, "steps" => $steps]) ?>
            <?php } ?>
            <?php if ($step > 1) { ?>
                <?= $this->render("/layouts/snippets/servizi/_nav-steps", ["step" => $step, "model" => $model]) ?>
            <?php } ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div><!-- contravvenzioni-_form -->