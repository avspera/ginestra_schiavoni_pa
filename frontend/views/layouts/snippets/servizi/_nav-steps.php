<div class="cmp-nav-steps">
    <nav class="steppers-nav" aria-label="Step">
        <button onclick="goBack('<?= $step ?>')" type="button" class="btn btn-sm steppers-btn-prev p-0">
            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-chevron-left"></use>
            </svg>
            <span class="text-button-sm t-primary">Indietro</span>
        </button>

        <?php if ($step <= 3) { ?>
            <button onclick="showFreezeModal()" type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn">
                <span class="text-button-sm t-primary">Salva Richiesta</span>
            </button>
        <?php } ?>

        <?php if ($step < 4) { ?>
            <button onclick="freezeAction('<?= $step ?>')" type="button" class="btn btn-primary btn-sm steppers-btn-confirm" data-bs-toggle="modal" data-bs-target="#modal-save-1">
                <span class="text-button-sm">Avanti</span>
                <svg class="icon icon-white icon-sm" aria-hidden="true">
                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-chevron-right"></use>
                </svg>
            </button>
        <?php } ?>

        <?php if ($step == 4) { ?>
            <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm send" data-bs-toggle="modal" data-bs-target="#modal-terms" data-focus-mouse="false">
                <span class="text-button-sm"><?= Yii::$app->controller->id == "contravvezioni" ? "Paga" : "Concludi" ?></span>
            </button>
        <?php } ?>
    </nav>
    <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
        <span class="d-inline-block text-uppercase cmp-disclaimer__message">Richiesta salvata con successo</span>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal-terms" aria-labelledby="modal-terms-modal-title" data-focus-mouse="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered small" role="document">
        <div class="modal-content modal-dimensions">
            <div class="cmp-modal__header modal-header pb-0">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
                </button>
                <h2 class="cmp-modal__header-title title-mini" id="modal-terms-modal-title">Termini e condizioni</h2>
                <p class="cmp-modal__header-info header-font">Cliccando su Conferma e invia confermi di aver preso visione dei termini e delle condizioni di servizio.</p>
                <a href="#" class="cmp-modal__header-link text-success underline mt-1">Leggi termini e condizioni</a>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer pb-70 pt-0">
                <button onclick="javascript:confirmAction('<?= $step ?>')" name="confirmAction" class="btn btn-primary w-100 mx-0 fw-bold mb-4" type="submit" data-bs-toggle="modal" data-bs-target="#" form="">Conferma e invia</button>
                <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal" type="button">Annulla</button>
            </div>
        </div>
    </div>
</div>

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
                <button class="btn btn-outline-success w-100 mx-0" onclick="freezeAction('<?= $step ?>', true)" type="button">Conferma e salva</button>
                <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal" type="button">Annulla</button>
            </div>
        </div>
    </div>
</div>

<script>
    function freezeAction(step, showAlert = false) {
        let attributes = $("form").serialize();
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
                    if (showAlert) {
                        $("#alert-message").removeClass("d-none");
                        $("#modal-freeze").modal("hide");
                    } else {
                        window.location.href = `create?id=<?= $model->id ?>&step=${step + 1}`;
                    }
                    clearFormDataSteps();
                }
            },
            error: function(richiesta, stato, errori) {
                alert("Attenzione: " + stato);
            }
        });
    }

    function confirmAction(step) {
        $("form.main-form").submit();
    }


    function showFreezeModal() {
        $("#modal-freeze").modal("show");
    }

    document.addEventListener('DOMContentLoaded', function() {
        //loadFormData();

        document.querySelectorAll('form[id^="new-"] input, form[id^="new-"] textarea, form[id^="new-"] select').forEach(element => {
            element.addEventListener('change', function() {
                saveFormData();
            });
        });
    });

    function saveFormData() {
        const step = getCurrentStep();
        const formData = {};
        document.querySelectorAll('input, textarea, select', 'radio').forEach(element => {
            formData[encodeURIComponent(element.name)] = element.value;
        });
        sessionStorage.setItem(`formDataStep${step}`, JSON.stringify(formData));
    }

    function clearFormDataSteps() {
        // Itera su tutte le chiavi di sessionStorage
        Object.keys(sessionStorage).forEach(key => {
            // Verifica se la chiave inizia con 'formDataStep'
            if (key.startsWith('formDataStep')) {
                // Rimuove la chiave
                sessionStorage.removeItem(key);
            }
        });
    }

    function loadFormData() {
        const step = getCurrentStep();
        const savedData = sessionStorage.getItem(`formDataStep${step}`);
        if (savedData) {
            const formData = JSON.parse(savedData);
            Object.keys(formData).forEach(name => {
                const decodedName = decodeURIComponent(name);
                const element = document.querySelector(`[name="${decodedName}"]`);
                if (element) {
                    element.value = formData[name];
                }
            });
        }
    }


    function getCurrentStep() {
        const urlParams = new URLSearchParams(window.location.search);
        return parseInt(urlParams.get('step')) || 1;
    }

    function goBack(step) {
        if (step > 1) {
            saveFormData();
            window.location.href = `create?id=<?= $model->id ?>&step=${step - 1}`;
        }
    }

    function goAhead(step) {
        // saveFormData();
        freezeAction(step);
        //window.location.href = `create?id=<?= $model->id ?>&step=${step + 1}`;
    }
</script>