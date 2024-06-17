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
    <button onclick="checkPrivacy()" type="button" class="btn btn-primary mobile-full">
        <span class="">Avanti</span>
    </button>

    <script>
        function checkPrivacy() {
            let isChecked = $("#privacy").prop("checked");

            if (!isChecked) {
                alert("Devi accettare l'informativa sulla privacy");
                return false;
            } else {
                window.location.href = "create?step=2";
            }
        }
    </script>