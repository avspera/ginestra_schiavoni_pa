<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var ActiveForm $form */
?>
<div class="contravvenzioni-form">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="title-xxxlarge mb-4">Paga contravvenzione</h1>
            </div>

            <div class="col-12">
                <div class="steppers">
                    <div class="steppers-header">
                        <ul>
                            <li class="active">
                                Informativa sulla privacy
                                <span class="visually-hidden">Attivo</span>
                            </li>
                            <li class="">
                                Dati Generali
                            </li>
                            <li class="">
                                Preferenze di servizio
                            </li>
                            <li class="">
                                Riepilogo
                            </li>
                        </ul>
                        <span class="steppers-index" aria-hidden="true">1/4</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 pb-40 pb-lg-80">
                <p class="text-paragraph mb-lg-4">
                    Il Comune di <?= Yii::$app->params["nomeComune"] ?> gestisce i dati personali forniti e liberamente comunicati sulla base dell’articolo 13 del Regolamento (UE) 2016/679 General data protection regulation (Gdpr) e degli articoli 13 e successive modifiche e integrazione del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti locali).
                </p>
                <p class="text-paragraph mb-0">
                    Per i dettagli sul trattamento dei dati personali consulta l’
                    <a href="#" class="t-primary">informativa sulla privacy.</a>
                </p>

                <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                    <div class="checkbox-body d-flex align-items-center">
                        <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field">
                        <label class="title-small-semi-bold pt-1" for="privacy">Ho letto e compreso l’informativa sulla privacy</label>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mobile-full">



                    <span class="">Avanti</span>
                </button>
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
</script>