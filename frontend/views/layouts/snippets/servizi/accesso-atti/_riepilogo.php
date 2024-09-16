<?php
$cittadino = Yii::$app->params["spidJsonUser"];
?>

<div class="progress-spinner progress-spinner-double progress-spinner-active d-none">
    <div class="progress-spinner-inner"></div>
    <div class="progress-spinner-inner"></div>
    <span class="visually-hidden">Caricamento...</span>
</div>

<div class="callout callout-highlight ps-3 warning">
    <div class="callout-title mb-20 d-flex align-items-center">
        <svg class="icon icon-sm" aria-hidden="true">
            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-horn"></use>
        </svg>
        <span>Attenzione</span>
    </div>
    <p class="titillium text-paragraph">Le informazioni che hai fornito hanno valore di dichiarazione.<span class="d-lg-block"> Verifica che siano corrette.</span></p>
</div>
<h2 class="title-xxlarge mb-4 mt-40">Dati Generali</h2>

<div class="cmp-card mb-4">
    <div class="card has-bkg-grey shadow-sm mb-0">
        <div class="card-header border-0 p-0 mb-lg-30">
            <div class="d-flex">
                <h3 class="subtitle-large mb-0">Effettuato da</h3>
            </div>
        </div>
        <div class="card-body p-0">

            <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-3 p-lg-4">
                <div class="card">

                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                        <h4 class="title-large-semi-bold mb-3"><?= $cittadino["fullname"] ?></h4>
                    </div>

                    <div class="card-body p-0">
                        <div class="single-line-info border-light">
                            <div class="text-paragraph-small">Codice Fiscale</div>
                            <div class="border-light border-0">
                                <p class="data-text">
                                    <?= strtoupper($cittadino["codice_fiscale"]) ?>
                                </p>



                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-0 d-none">
                    </div>
                </div>
            </div>
            <div class="cmp-info-summary bg-white p-3 p-lg-4">
                <div class="card">

                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                        <h4 class="title-large-semi-bold mb-3">Indirizzo</h4>
                    </div>

                    <div class="card-body p-0">
                        <div class="single-line-info border-light">
                            <div class="text-paragraph-small">Residenza</div>
                            <div class="border-light border-0">
                                <p class="data-text">
                                    <?= $cittadino["indirizzo"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-0 d-none">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h2 class="title-xxlarge mb-4 pt-3 pt-lg-0">Dati specifici del servizio</h2>

<div>
    <div class="cmp-card mb-4">
        <div class="card has-bkg-grey shadow-sm mb-0">
            <div class="card-header border-0 p-0 mb-lg-30">
                <div class="d-flex">
                    <h3 class="subtitle-large mb-0">Accesso agli atti</h3>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="cmp-info-summary bg-white p-3 p-lg-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Oggetto della richiesta</div>
                                <div class="border-light">
                                    <p class="data-text" id="AccessoAtti[oggetto_richiesta]"></p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Tipo di richiesta</div>
                                <div class="border-light">
                                    <p class="data-text">
                                        <?= $model->getType() ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Pagamento oneri</div>
                                <div class="border-light">
                                    <p class="data-text" id="pagamento_oneri_summary"></p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Importo dovuto</div>
                                <div class="border-light">
                                    <p class="data-text" id="importo_summary"></p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Ulteriori comunicazioni</div>
                                <div class="border-light">
                                    <p id="AccessoAtti[messaggio_richiesta]" class="data-text"> </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-0 d-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showSpinner() {
        const spinner = document.querySelector(".progress-spinner");
        spinner.style.display = "block"; // Mostra lo spinner
    }

    function hideSpinner() {
        const spinner = document.querySelector(".progress-spinner");
        spinner.style.display = "none"; // Nascondi lo spinner
    }

    function loadSummaryData() {

        showSpinner();

        setTimeout(() => {
            let step = <?= $step - 1 ?>;
            const savedData = sessionStorage.getItem(`formDataStep${step}`);
            if (savedData) {
                const formData = JSON.parse(savedData);
                Object.keys(formData).forEach(name => {
                    const decodedName = decodeURIComponent(name);
                    const element = document.querySelector(`[id="${decodedName}"]`);
                    if (element) {
                        element.innerText = formData[name];
                    }
                });
            }

            // Tipo di richiesta
            const tipoRichiesta = sessionStorage.getItem("formDataStepTipoRichiesta");
            if (tipoRichiesta) {
                document.querySelector("#tipo_richiesta_summary").innerText = tipoRichiesta == 1 ? "Standard" : "Diritti di urgenza (entro 3 giorni lavorativi)";
            }

            // Pagamento oneri
            const pagamentoOneri = sessionStorage.getItem("formDataStepTipoRichiesta");
            if (pagamentoOneri == 1) {
                document.querySelector("#pagamento_oneri_summary").innerText = "Nessuno";
                document.querySelector("#importo_summary").innerText = "0,00";
            } else {
                document.querySelector("#pagamento_oneri_summary").innerText = "Diritti di urgenza";
                document.querySelector("#importo_summary").innerText = "€ 150,00";
            }

            hideSpinner();
        }, 2000); // Simuliamo un caricamento con un timeout di 1 secondo
    }

    // Chiama questa funzione quando la pagina viene caricata
    window.onload = function() {
        loadSummaryData();
    }
</script>