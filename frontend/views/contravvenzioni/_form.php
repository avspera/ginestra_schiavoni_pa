<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$step = isset($_GET["step"]) ? $_GET["step"] : 1;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var ActiveForm $form */
?>
<div class="contravvenzioni-form">

    <div class="container">
        <h1 class="title-xxxlarge mb-4">Paga contravvenzione</h1>

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
                    <?php if ($step == 1) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_privacy") ?>
                    <?php } else if ($step == 2) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_dati-generali") ?>
                    <?php } else if ($step == 3) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_dati-specifici-multa") ?>
                    <?php } else if ($step == 4) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_riepilogo") ?>
                    <?php } ?>

                    <?php if ($step > 1) { ?>
                        <?= $this->render("/layouts/snippets/servizi/_nav-steps", ["step" => $step]) ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- contravvenzioni-_form -->

<script>
    function search() {
        let cf = $("#contravvenzioni-cf").val();
        let iuv = $("#contravvenzioni-id_univoco_versamento").val();

        if (cf.length == 0 || iuv.length == 0) return false;

        $.ajax({
            url: '<?= Url::to(["contravvenzioni/search"]) ?>',
            type: 'get',
            dataType: 'json',
            data: {
                cf: cf,
                iuv: iuv
            },
            success: function(data) {
                if (data.status == 100) {
                    let html = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Attenzione!</strong> ${data.msg}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>`;
                    $("#result-message").append(html);
                    return false;
                }
            },
            error: function(richiesta, stato, errori) {
                alert("Attenzione: " + stato);
            }
        });
    }

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
</script>