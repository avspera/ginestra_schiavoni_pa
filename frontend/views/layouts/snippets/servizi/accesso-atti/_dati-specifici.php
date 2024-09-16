<div class="it-page-sections-container">
    <p class="text-paragraph-small mt-3 mb-40 mb-lg-25">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>

    <section class="it-page-section" id="general-choice">
        <div class="cmp-card mb-40">
            <div class="card has-bkg-grey shadow-sm p-4 pt-lg-30 pb-lg-30 pl-lg-30 pr-lg-30">
                <div class="card-header border-0 p-0 mb-lg-30 m-0">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0 icon-required">Accesso agli atti</h2>
                    </div>
                </div>
                <div class="card-body p-0">
                    <h3 class="h4 mb-3">Inserisci un riferimento all'atto</h3>
                    <div class="form-group">
                        <input
                            type="text"
                            class="form-control"
                            id="accessoatti-oggetto_richiesta"
                            name="AccessoAtti[oggetto_richiesta]"
                            value="<?= htmlspecialchars($model->oggetto_richiesta) ?>"
                            placeholder="Riferimento atto"
                            aria-describedby="oggetto_richiesta-desc">
                        <small id="oggetto_richiesta-desc" class="form-text">Usa questo campo per descrivere tutti i riferimenti all'atto a cui richiedi l'accesso. Ad esempio, numero della delibera, data del consiglio comunale etc...</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="it-page-section" id="type-choice">
        <div class="cmp-card mb-40">
            <div class="card has-bkg-grey shadow-sm p-4 pt-lg-30 pb-lg-30 pl-lg-30 pr-lg-30">
                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-1 icon-required">Tipo di richiesta</h2>
                    </div>
                    <p class="subtitle-small mb-0 mb-4">Specifica il tipo di richiesta</p>
                </div>
                <div class="card-body p-0">
                    <div class="cmp-card-radio">
                        <div class="card card-teaser">
                            <div class="card-body">
                                <div class="form-check m-0">
                                    <div class="radio-body border-bottom border-light">
                                        <input
                                            <?= $model->type == 1 ? "checked" : "" ?>
                                            onclick="checkPayment(1)"
                                            value="1"
                                            name="AccessoAtti[type]"
                                            type="radio"
                                            id="accessoatti-type-1"
                                            required>
                                        <label for="accessoatti-type-1">Standard</label>
                                    </div>
                                </div>
                                <div class="form-check m-0">
                                    <div class="radio-body border-bottom border-light">
                                        <input
                                            <?= $model->type == 2 ? "checked" : "" ?>
                                            onclick="checkPayment(2)"
                                            value="2"
                                            name="AccessoAtti[type]"
                                            type="radio"
                                            id="accessoatti-type-2"
                                            required>
                                        <label for="accessoatti-type-2">Diritti di urgenza (esercizio del diritto di accesso entro 3 giorni lavorativi)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="it-page-section" id="payment-choice">
        <div class="cmp-card mb-40">
            <div class="card has-bkg-grey shadow-sm p-4 pt-lg-30 pb-lg-30 pl-lg-30 pr-lg-30">
                <div class="card-header border-0 p-0 mb-lg-30 m-0">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0 icon-required">Pagamento oneri</h2>
                    </div>
                    <p class="subtitle-small mb-0 mb-4">Gli oneri sono selezionati in base al tipo di richiesta</p>
                </div>
                <div class="card-body p-0">
                    <div class="bg-white p-3 p-lg-4">
                        <div class="form-check m-0">
                            <div class="radio-body border-bottom border-light">
                                <input
                                    <?= $model->type == 1 ? "checked" : "disabled" ?>
                                    value="1"
                                    name="AccessoAtti[payment]"
                                    type="radio"
                                    id="accessoatti-payment-1"
                                    required>
                                <label class="<?= $model->type == 1 ? "" : "disabled" ?>" for="accessoatti-payment-1">Nessuno</label>
                            </div>
                            <div class="radio-body border-bottom border-light">
                                <input
                                    <?= $model->type == 2 ? "checked" : "disabled" ?>
                                    value="2"
                                    aria-labelledby="accessoatti-payment-2-help"
                                    name="AccessoAtti[payment]"
                                    type="radio"
                                    id="accessoatti-payment-2"
                                    required>
                                <label class="<?= $model->type == 2 ? "" : "disabled" ?>" for="accessoatti-payment-2">150 €</label>
                                <small id="accessoatti-payment-2-help" class="form-text">*Diritti di urgenza (esercizio del diritto di accesso entro 3 giorni lavorativi)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="it-page-section" id="extra-message">
        <div class="cmp-card mb-40">
            <div class="card has-bkg-grey shadow-sm p-4 pt-lg-30 pb-lg-30 pl-lg-30 pr-lg-30">
                <div class="card-header border-0 p-0 mb-lg-30 m-0">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0">Ulteriori comunicazioni</h2>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="bg-white p-3 p-lg-4">
                        <div class="form-group">
                            <label for="accessoatti-messaggio_richiesta">Usa quest'area di testo per aggiungere ulteriori informazioni</label>
                            <textarea class="form-control" name="AccessoAtti[messaggio_richiesta]" id="accessoatti-messaggio_richiesta" rows="3"><?= htmlspecialchars($model->messaggio_richiesta) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    function checkPayment(value) {
        // Definizione degli elementi di input e label per entrambi i valori
        const payment1 = $("#accessoatti-payment-1");
        const label1 = $("label[for=accessoatti-payment-1]");
        const payment2 = $("#accessoatti-payment-2");
        const label2 = $("label[for=accessoatti-payment-2]");

        // Funzione helper per gestire abilitazione e disabilitazione
        function togglePayment(activePayment, activeLabel, inactivePayment, inactiveLabel) {
            activePayment.prop("checked", true).prop("disabled", false);
            activeLabel.removeClass("disabled");
            inactivePayment.prop("disabled", true);
            inactiveLabel.addClass("disabled");
        }

        if (value == 1) {
            togglePayment(payment1, label1, payment2, label2);
        } else if (value == 2) {
            togglePayment(payment2, label2, payment1, label1);
        }
    }
</script>