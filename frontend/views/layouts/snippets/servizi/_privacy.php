<?php
if (!empty($datiPrivacy)) {
    $datiPrivacy = json_decode($datiPrivacy["data"], true);
} else {
    $datiPrivacy = [];
}

$model->privacy = isset($datiPrivacy["ParcheggioResidenti"]["privacy"]) ? $datiPrivacy["ParcheggioResidenti"]["privacy"] : "";

?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-8 pb-4 pb-lg-8">
        <p class="text-paragraph mb-lg-4">
            Il Comune di <?= Yii::$app->params["nomeComune"] ?> gestisce i dati personali forniti e liberamente comunicati sulla base dell’articolo 13 del Regolamento (UE) 2016/679 General Data Protection Regulation (GDPR) e degli articoli 13 e successive modifiche e integrazioni del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti locali).
        </p>
        <p class="text-paragraph mb-0">
            Per i dettagli sul trattamento dei dati personali consulta l’ <a href="#" class="t-primary">informativa sulla privacy.</a>
        </p>

        <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
            <div class="checkbox-body d-flex align-items-center">
                <input <?= $model->privacy ? "checked" : "" ?> type="checkbox" id="parcheggioresidenti-privacy" name="ParcheggioResidenti[privacy]">
                <label class="title-small-semi-bold pt-1" for="parcheggioresidenti-privacy">Ho letto e compreso l’informativa sulla privacy</label>
            </div>
        </div>

        <button onclick="checkPrivacy()" type="button" class="btn btn-primary mobile-full">
            <span>Avanti</span>
        </button>
    </div>
</div>

<script>
    function checkPrivacy() {
        // Usa 'getElementById' per ottenere lo stato del checkbox
        let isChecked = document.getElementById("parcheggioresidenti-privacy").checked;

        if (!isChecked) {
            alert("Devi accettare l'informativa sulla privacy");
            return false;
        } else {
            freezeAction();
        }

        function freezeAction() {
            let attributes = $("form").serialize();
            let step = '<?= $step ?>';
            step = Number.isNaN(step) ? 1 : Number.parseInt(step);
            $.ajax({
                url: '<?= "/" . Yii::$app->controller->id . "/save-step-data?id=" . $model->id . "&step=" . $step ?>',
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
                    } else {
                        window.location.href = `create?id=<?= $model->id ?>&step=${step + 1}`;
                    }
                },
                error: function(richiesta, stato, errori) {
                    alert("Attenzione: " + stato);
                }
            });
        }
    }
</script>