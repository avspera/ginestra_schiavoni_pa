<?php

use common\components\Utils;
use common\models\Coniuge;

$datiGenerali   = json_decode($steps[1]["data"], true);
$datiSpecifici  = json_decode($steps[2]["data"], true);

$coniuge        = Coniuge::find()->where(["id" => $datiGenerali["AttoDiMatrimonio"]["coniuge"]])->one();

?>
<div class="row">
    <div class="col-12 col-lg-3 mb-4 d-none d-lg-block">
        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INFORMAZIONI RICHIESTE" data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                    <div class="menu-wrapper">
                        <div class="link-list-wrapper">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <span class="accordion-header" id="accordion-title-one">
                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                            INFORMAZIONI RICHIESTE
                                            <svg class="icon icon-xs right">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                    </div>
                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                        <div class="accordion-body">
                                            <ul class="link-list" data-element="page-index">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#applicant-info">
                                                        <span>Richiedente</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#coniuge-info">
                                                        <span>Coniuge</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#preferenze-info">
                                                        <span>Prefenze di servizio</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>


    <div class="col-12 col-lg-8 offset-lg-1">
        <div class="steppers-content" aria-live="polite">
            <div class="it-page-sections-container">

                <section class="it-page-section">

                    <div class="callout callout-highlight ps-3 warning">
                        <div class="callout-title mb-20 d-flex align-items-center">
                            <svg class="icon icon-sm" aria-hidden="true">
                                <use href="/bootstrap-italia/svg/sprites.svg#it-horn"></use>
                            </svg>
                            <span>Attenzione</span>
                        </div>
                        <p class="titillium text-paragraph">Le informazioni che hai fornito hanno valore di dichiarazione.<span class="d-lg-block"> Verifica che siano corrette.</span></p>
                    </div>
                    <h2 class="title-xxlarge mb-4 mt-40">Dati Generali</h2>

                    <div class="cmp-card mb-4">
                        <div class="card has-bkg-grey shadow-sm mb-0">
                            <div class="card-header border-0 p-0">
                                <div class="d-flex">
                                    <h3 class="subtitle-large mb-4" id="applicant-info">Richiedente</h3>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <!-- Sezione "Richiedente" -->
                                <div class="cmp-info-summary bg-white mb-4 p-3 p-lg-4">
                                    <div class="card">
                                        <div class="card-header border-bottom border-light p-0 d-flex justify-content-between">
                                            <h4 class="title-large-semi-bold mb-3"><?= $cittadino->fullname ?></h4>
                                            <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Codice fiscale</div>
                                                <p class="data-text"><?= $cittadino->codice_fiscale ?></p>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Data di Nascita</div>
                                                <p class="data-text"><?= $cittadino->data_di_nascita ?></p>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Luogo di Nascita</div>
                                                <p class="data-text"><?= $cittadino->luogo_di_nascita ?></p>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Sesso</div>
                                                <p class="data-text"><?= $cittadino->sesso ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sezione "Indirizzo" -->
                                <div class="cmp-info-summary bg-white mb-4 p-3 p-lg-4">
                                    <div class="card">
                                        <div class="card-header border-bottom border-light p-0 d-flex justify-content-between">
                                            <h4 class="title-large-semi-bold mb-3">Indirizzo</h4>
                                            <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Residenza</div>
                                                <p class="data-text"><?= $cittadino->indirizzo_di_residenza ?></p>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Domicilio</div>
                                                <p class="data-text"><?= $cittadino->indirizzo_di_domicilio ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sezione "Contatti" -->
                                <div class="cmp-info-summary bg-white mb-4 p-3 p-lg-4">
                                    <div class="card">
                                        <div class="card-header border-bottom border-light p-0 d-flex justify-content-between">
                                            <h4 class="title-large-semi-bold mb-3">Contatti</h4>
                                            <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Telefono</div>
                                                <p class="data-text"><?= $cittadino->telefono ?></p>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Email</div>
                                                <p class="data-text"><?= $cittadino->email ?></p>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Recapito postale</div>
                                                <p class="data-text"><?= $cittadino->indirizzo_di_residenza ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sezione "Documenti" -->
                                <div class="cmp-info-summary bg-white p-3 p-lg-4 mb-0">
                                    <div class="card">
                                        <div class="card-header border-bottom border-light p-0 d-flex justify-content-between">
                                            <h4 class="title-large-semi-bold mb-3">Documenti</h4>
                                            <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                        </div>

                                        <div class="card-body p-0">
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Carta di identità</div>
                                                <p class="data-text">
                                                    <?php
                                                    if (!empty($cittadino->patente_di_guida)) {
                                                        $patente = explode(",", $cittadino->patente_di_guida);
                                                        foreach ($patente as $pt) {
                                                            echo substr($pt, strrpos($pt, "/") + 1) . ' ';
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="cmp-card mb-4">
                        <div class="card has-bkg-grey shadow-sm mb-0">
                            <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                <div class="d-flex">
                                    <h3 class="subtitle-large mb-4" id="coniuge-info">Coniuge</h3>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <h3 class="big-title mt-2 mb-0"><?= $coniuge->nome . " " . $coniuge->cognome ?></h3>
                                <p class="card-info">Codice Fiscale <br> <span><?= $coniuge->codice_fiscale ?></span></p>
                                <div class="accordion-item">
                                    <div class="accordion-header" id="heading-collapse-coniuge">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-coniuge" aria-expanded="true" aria-controls="collapse-coniuge">
                                            <span class="d-flex align-items-center">
                                                Mostra tutto
                                                <svg class="icon icon-primary icon-sm">
                                                    <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    <div id="collapse-coniuge" class="accordion-collapse collapse" role="region">
                                        <div class="accordion-body p-0">
                                            <div class="cmp-info-summary bg-white has-border">
                                                <div class="card">
                                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                        <h4 class="title-large-semi-bold mb-3"><?= $coniuge->nome . " " . $coniuge->cognome ?></h4>
                                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Nome</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->nome ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Cognome</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->cognome ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Codice fiscale</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->codice_fiscale ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Data di Nascita</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= Utils::formatDate($coniuge->data_di_nascita) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Luogo di Nascita</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->luogo_di_nascita ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Sesso</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= !empty($coniuge->sesso) ? $coniuge->sesso : "-" ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Stato civile</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $cittadino->getStatoCivile($coniuge->stato_civile) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Titolo di studio</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $cittadino->getTitoloStudio($coniuge->titolo_di_studio) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Posizione professionale</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $cittadino->getPosizioneProfessionale($coniuge->posizione_professionale) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Condizione non professionale</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $cittadino->getCondizioneNonProfessionale($coniuge->condizione_non_professionale) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer p-0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cmp-info-summary bg-white has-border">
                                                <div class="card">

                                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                        <h4 class="title-large-semi-bold mb-3">Indirizzi</h4>
                                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                    </div>

                                                    <div class="card-body p-0">
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Residenza</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= !empty($coniuge->indirizzo_di_residenza) ? $coniuge->indirizzo_di_residenza : "-" ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Domicilio</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= !empty($coniuge->indirizzo_di_domicilio) ? $coniuge->indirizzo_di_domicilio : "-" ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer p-0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cmp-info-summary bg-white has-border">
                                                <div class="card">

                                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                        <h4 class="title-large-semi-bold mb-3">Contatti</h4>
                                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                    </div>

                                                    <div class="card-body p-0">
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Telefono</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->telefono ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Email</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->email ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="single-line-info border-light">
                                                            <div class="text-paragraph-small">Recapito postale</div>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?= $coniuge->indirizzo_di_residenza ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer p-0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cmp-info-summary bg-white has-border">
                                                <div class="card">

                                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                        <h4 class="title-large-semi-bold mb-3">Documenti</h4>
                                                        <a href="#" class="d-none text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                    </div>

                                                    <div class="card-body p-0">

                                                        <?php if (!empty($coniuge->carta_identita)) { ?>
                                                            <div class="border-light">
                                                                <p class="data-text">
                                                                    <?php
                                                                    $patente = explode(",", $coniuge->carta_identita);
                                                                    foreach ($patente as $pt) {
                                                                        echo substr($pt, strrpos($pt, "/"));
                                                                    }
                                                                    ?>
                                                                </p>
                                                                <p class="fw-semibold pb-2 pt-2 data-text description-success d-flex align-items-center">
                                                                    <span class="d-flex align-items-center">
                                                                        <svg class="icon icon-sm icon-success" aria-hidden="true">
                                                                            <use href="/bootstrap-italia/svg/sprites.svg#it-check-circle"></use>
                                                                        </svg>
                                                                        Documento caricato con successo
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="single-line-info border-light" id="applicant-warning">
                                                                <div class="text-paragraph-small">Carta di identità</div>
                                                                <p class="fw-semibold data-text description-alert d-flex align-items-center border-light">
                                                                    <span class="d-flex align-items-center">
                                                                        <svg class="icon icon-sm icon-warning" aria-hidden="true">
                                                                            <use href="/bootstrap-italia/svg/sprites.svg#it-error"></use>
                                                                        </svg>
                                                                        Documento mancante
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="title-xxlarge mb-4 mt-40" id="preferenze-info">Preferenze di servizio</h2>
                    <div class="cmp-card">
                        <div class="card has-bkg-grey shadow-sm">
                            <div class="card-body p-0">
                                <div class="cmp-info-summary bg-white p-3 p-lg-4">
                                    <div class="card">
                                        <div class="card-header border-bottom border-light p-0 mb-0 pb-2 d-flex justify-content-end">
                                            <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Durata permesso</div>
                                                <div class="border-light">
                                                    <p id="durata-text" class="data-text">
                                                        <?= $model->getDurata() ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="single-line-info border-light">
                                                <div class="text-paragraph-small">Periodo di validità</div>
                                                <div class="border-light">
                                                    <p class="data-text">
                                                        <?php
                                                        $today = date("Y-m-d");
                                                        $dataEsito = Utils::calcolaDataScadenza($today, "+1 year");
                                                        ?>
                                                        <?= Utils::formatDate($today) . " - " . Utils::formatDate($dataEsito) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer p-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>