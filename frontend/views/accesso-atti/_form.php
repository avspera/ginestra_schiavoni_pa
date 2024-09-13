<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$step = isset($_GET["step"]) ? $_GET["step"] : 1;

/** @var yii\web\View $this */
/** @var common\models\AccessoAtti $model */
/** @var ActiveForm $form */
?>
<div class="accesso-atti-form">

    <div class="container">
        <h1 class="title-xxxlarge mb-4">Richiedi Accesso agli Atti</h1>

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
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 pb-4 pb-lg-8">
                    <?php $form = ActiveForm::begin([
                        'id' => "new-accesso-atti",
                    ]) ?>
                    <?= $form->field($model, "id")->hiddenInput()->label(false); ?>
                    <?= $form->field($model, "id_cittadino")->hiddenInput()->label(false); ?>

                    <?php if ($step == 1) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_privacy") ?>
                    <?php } else if ($step == 2) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_dati-generali", ["model" => $model]) ?>
                    <?php } else if ($step == 3) { ?>
                        <?= $this->render("/layouts/snippets/servizi/accesso-atti/_dati-specifici", ["model" => $model]) ?>
                    <?php } else if ($step == 4) { ?>
                        <?= $this->render("/layouts/snippets/servizi/accesso-atti/_riepilogo", ["model" => $model]) ?>
                    <?php } ?>
                    <?php if ($step > 1) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_nav-steps", ["step" => $step, "model" => $model, "url" => "accesso-atti/create"]) ?>
                    <?php } ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- contravvenzioni-_form -->

<div class="modal fade" tabindex="-1" id="modal-freeze" aria-labelledby="modal-freeze-modal-title" data-focus-mouse="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered small" role="document">
        <div class="modal-content modal-dimensions">
            <div class="cmp-modal__header modal-header pb-0">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
                </button>
                <h2 class="cmp-modal__header-title title-mini" id="modal-terms-modal-title">Salva la richiesta</h2>
                <p class="cmp-modal__header-info header-font">Cliccando su "Conferma e salva" la tua richiesta sarà salvata nello stato in cui si trova. Potrai riprendere in futuro da dove ti sei fermato.</p>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer pb-70 pt-0">
                <button class="btn btn-outline-success w-100 mx-0" onclick="freezeAction('<?= $step ?>')" type="button">Conferma e salva</button>
                <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal" type="button">Annulla</button>
            </div>
        </div>
    </div>
</div>

<script>
    function goBack(step) {
        if (step > 1) {
            window.location.href = "create?step=" + (step - 1);
        } else {
            return false;
        }
    }

    function goAhead(step) {
        window.location.href = "create?step=" + (step + 1);
    }

    function freezeAction(step) {
        let attributes = $("form").serialize();

        $.ajax({
            url: '<?= Url::to(["accesso-atti/create"]) ?>',
            type: 'post',
            dataType: 'json',
            data: attributes,
            success: function(data) {
                if (data.status == 100) {
                    let html = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Attenzione!</strong> ${data.msg}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>`;
                    $("#result-message").append(html);
                    return false;
                } else {
                    $("#alert-message").removeClass("d-none");
                    $("#modal-freeze").modal("hide");
                }
            },
            error: function(richiesta, stato, errori) {
                alert("Attenzione: " + stato);
            }
        });

    }
</script>