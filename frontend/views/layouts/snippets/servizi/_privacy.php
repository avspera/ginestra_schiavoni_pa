<p class="text-paragraph mb-lg-4">
    Il Comune di <?= Yii::$app->params["nomeComune"] ?> gestisce i dati personali forniti e liberamente comunicati sulla base dell’articolo 13 del Regolamento (UE) 2016/679 General Data Protection Regulation (GDPR) e degli articoli 13 e successive modifiche e integrazioni del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti locali).
</p>
<p class="text-paragraph mb-0">
    Per i dettagli sul trattamento dei dati personali consulta l’
    <a href="#" class="t-primary">informativa sulla privacy.</a>
</p>

<div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
    <div class="checkbox-body d-flex align-items-center">
        <input <?= $model->privacy ? "checked" : "" ?> type="checkbox" id="accessoatti-privacy" name="AccessoAtti[privacy]">
        <label class="title-small-semi-bold pt-1" for="accessoatti-privacy">Ho letto e compreso l’informativa sulla privacy</label>
    </div>
</div>

<button onclick="checkPrivacy()" type="button" class="btn btn-primary mobile-full">
    <span>Avanti</span>
</button>

<script>
    function checkPrivacy() {
        // Usa 'getElementById' per ottenere lo stato del checkbox
        let isChecked = document.getElementById("accessoatti-privacy").checked;
        
        if (!isChecked) {
            alert("Devi accettare l'informativa sulla privacy");
            return false;
        } else {
            // Vai al prossimo step se la privacy è stata accettata
            window.location.href = `create?id=<?= $model->id ?>&step=2`;
        }
    }
</script>