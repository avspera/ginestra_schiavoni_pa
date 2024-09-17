<?php

use common\components\Utils;

$this->title = "Richiesta #" . $model->numero_protocollo . " del " . Utils::formatDate($model->data_creazione);

$this->params['breadcrumbs'][] = [
    'label' => 'Accesso agli atti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];

$cittadino = Yii::$app->params["spidJsonUser"];
?>
<div class="callout callout-highlight ps-3 warning">
    <div class="callout-title mb-20 d-flex align-items-center">
        <svg class="icon icon-sm" aria-hidden="true">
            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-horn"></use>
        </svg>
        <span>Stato della richiesta</span>
    </div>
    <p class="titillium text-paragraph">Stato attuale della richiesta: <span class="d-lg-block"><strong> <?= \common\components\Utils::getStatoRichiesta($model->stato_richiesta) ?></strong>.</span></p>
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
                                <div class="text-paragraph-small">Stato della richiesta</div>
                                <div class="border-light">
                                    <p class="data-text">
                                        <?= \common\components\Utils::getStatoRichiesta($model->stato_richiesta) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Oggetto della richiesta</div>
                                <div class="border-light">
                                    <p class="data-text">
                                        <?= $model->oggetto_richiesta ?>
                                    </p>
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
                                    <p class="data-text">
                                        <?php if ($model->type == $model->type_choices_flipped["standard"]) { ?>
                                            <small><strong>Nessuno</strong></small>
                                        <?php } else { ?>
                                            <small>Diritti di urgenza (esercizio del diritto di accesso entro 3gg lavorativi)</small>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Importo dovuto</div>
                                <div class="border-light">
                                    <p class="data-text">
                                        <?php if ($model->type == $model->type_choices_flipped["standard"]) { ?>
                                            0,00
                                        <?php } else { ?>
                                            € 150, 00
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                            <div class="single-line-info border-light">
                                <div class="text-paragraph-small">Ulteriori comunicazioni</div>
                                <div class="border-light">
                                    <p class="data-text">
                                        <?= $model->note ?>
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
                <button onclick="javascript:confirmAction()" name="confirmAction" class="btn btn-primary w-100 mx-0 fw-bold mb-4" type="submit" data-bs-toggle="modal" data-bs-target="#" form="">Conferma e invia</button>
                <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal" type="button">Annulla</button>
            </div>
        </div>
    </div>
</div>