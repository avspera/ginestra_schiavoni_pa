<?php

use common\components\Utils;
use common\models\Coniuge;

?>

<div class="row">
    <div class="col-12 col-lg-3 mb-4 d-none d-lg-block">
        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Informazioni Richieste" data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                    <div class="menu-wrapper">
                        <div class="link-list-wrapper">
                            <div class="accordion" id="accordion-info">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="accordion-title-one">
                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                            Informazioni Richieste
                                            <svg class="icon icon-xs right">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </button>
                                    </h2>
                                    <div class="progress">
                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                    </div>
                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                        <div class="accordion-body">
                                            <ul class="link-list" data-element="page-index">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#coniuge-uno-info">
                                                        <span>Richiedente</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#coniuge-due-info">
                                                        <span>Coniuge</span>
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

    <div class="col-12 col-lg-8 offset-lg-1 mt-2 mt-lg-0">

        <div class="it-page-sections-container">
            <section class="it-page-section" id="coniuge-uno-info">
                <div class="cmp-card mb-40">
                    <div class="card has-bkg-grey shadow-sm">
                        <div class="card-header border-0 p-0 mb-lg-20">
                            <div class="d-flex">
                                <h2 class="title-xxlarge mb-1">Richiedente</h2>
                            </div>
                            <p class="subtitle-small mb-0">Aggiungi o modifica le tue informazioni</p>
                        </div>

                        <fieldset>
                            <legend class="visually-hidden">Aggiungi o modifica le tue informazioni
                            </legend>
                            <div class="card-body p-0">
                                <div class="cmp-info-button-card">
                                    <div class="card p-3 p-lg-4">
                                        <div class="card-body p-0">
                                            <h3 class="big-title mb-0"><?= $cittadino->fullname ?></h3>
                                            <p class="card-info">Codice Fiscale <br> <span><?= $cittadino->codice_fiscale ?></span></p>

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
                                                <div id="collapse-coniuge" class="accordion-collapse collapse show" role="region">
                                                    <div class="accordion-body p-0">
                                                        <div class="cmp-info-summary bg-white has-border">
                                                            <div class="card">
                                                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                                    <h4 class="title-large-semi-bold mb-3">Anagrafica</h4>
                                                                    <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                                </div>
                                                                <div class="card-body p-0">
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Nome</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->nome ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Cognome</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->cognome ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Codice fiscale</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->codice_fiscale ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Data di Nascita</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= Utils::formatDate($cittadino->data_di_nascita) ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Luogo di Nascita</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->luogo_di_nascita ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Sesso</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->sesso ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Stato civile</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->getStatoCivile($cittadino->stato_civile) ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Titolo di studio</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->getTitoloStudio($cittadino->titolo_studio) ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Posizione professionale</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->getPosizioneProfessionale($cittadino->posizione_professionale) ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Condizione non professionale</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->getCondizioneNonProfessionale($cittadino->condizione_non_professionale) ?>
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
                                                                                <?= $cittadino->indirizzo_di_residenza ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Domicilio</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->indirizzo_di_domicilio ?>
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
                                                                                <?= $cittadino->telefono ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Email</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->email ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="single-line-info border-light">
                                                                        <div class="text-paragraph-small">Recapito postale</div>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?= $cittadino->indirizzo_di_residenza ?>
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

                                                                    <?php if (!empty($item->carta_di_identita)) { ?>
                                                                        <div class="border-light">
                                                                            <p class="data-text">
                                                                                <?php
                                                                                $patente = explode(",", $item->carta_di_identita);
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
                                                                <div class="card-footer p-0">
                                                                    <?php if (empty($model->allegato_1)) { ?>
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal-cittadino" class="btn btn-outline-primary w-100 mt-3">
                                                                            <span class="rounded-icon">
                                                                                <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                                                    <use href="/bootstrap-italia/svg/sprites.svg#it-pencil"></use>
                                                                                </svg>
                                                                            </span>
                                                                            <span class="">Aggiungi</span>
                                                                        </button>
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
                            </div>
                        </fieldset>
                    </div>
                </div>
            </section>

            <section class="it-page-section" id="coniuge-due-info">
                <div class="cmp-card">
                    <div class="card has-bkg-grey shadow-sm">
                        <div class="card-header border-0 p-0 mb-lg-20">
                            <div class="d-flex">
                                <h2 class="title-xxlarge mb-1">Coniuge</h2>
                            </div>
                            <p class="subtitle-small mb-0">Aggiungi o modifica le informazioni del tuo coniuge</p>
                        </div>
                        <div class="card-body p-0">
                            <fieldset>
                                <legend class="visually-hidden">Seleziona o aggiungi il coniuge
                                </legend>
                                <?php
                                $i = 0;
                                foreach ($coniuge as $item) {
                                ?>
                                    <div class="cmp-info-button-card radio-card">
                                        <div class="card p-3 p-lg-4">
                                            <div class="card-header mb-0 p-0">
                                                <div class="form-check m-0">
                                                    <input
                                                        <?= (!empty($model->coniuge) && $item->id == $model->coniuge) ? "checked" : "" ?>
                                                        value="<?= $item->id ?>"
                                                        class="radio-input"
                                                        name="AttoDiMatrimonio[coniuge]"
                                                        type="radio"
                                                        id="attodimatrimonio-coniuge-<?= $item->id ?>">
                                                    <label for="attodimatrimonio-coniuge-<?= $item->id ?>">
                                                        <h3 class="big-title mb-0"><?= $model->coniuge ?></h3>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="card-body">
                                                <h3 class="big-title mt-2 mb-0"><?= $item->nome . " " . $item->cognome ?></h3>
                                                <p class="card-info">Codice Fiscale <br> <span><?= $item->codice_fiscale ?></span></p>

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
                                                    <div id="collapse-coniuge" class="accordion-collapse collapse show" role="region">
                                                        <div class="accordion-body p-0">
                                                            <div class="cmp-info-summary bg-white has-border">
                                                                <div class="card">
                                                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                                        <h4 class="title-large-semi-bold mb-3">Anagrafica</h4>
                                                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                                    </div>
                                                                    <div class="card-body p-0">
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Nome</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $item->nome ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Cognome</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $item->cognome ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Codice fiscale</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $item->codice_fiscale ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Data di Nascita</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= Utils::formatDate($item->data_di_nascita) ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Luogo di Nascita</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $item->luogo_di_nascita ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Sesso</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= !empty($item->sesso) ? $item->sesso : "-" ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Stato civile</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $cittadino->getStatoCivile($item->stato_civile) ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Titolo di studio</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $cittadino->getTitoloStudio($item->titolo_di_studio) ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Posizione professionale</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $cittadino->getPosizioneProfessionale($item->posizione_professionale) ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Condizione non professionale</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $cittadino->getCondizioneNonProfessionale($item->condizione_non_professionale) ?>
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
                                                                                    <?= !empty($item->indirizzo_residenza) ? $item->indirizzo_residenza : "-" ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Domicilio</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= !empty($item->indirizzo_domicilio) ? $item->indirizzo_domicilio : "-" ?>
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
                                                                                    <?= $item->telefono ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Email</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $item->email ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Recapito postale</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?= $item->indirizzo_residenza ?>
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

                                                                        <?php if (!empty($item->carta_identita)) { ?>
                                                                            <div class="border-light">
                                                                                <p class="data-text">
                                                                                    <?php
                                                                                    $patente = explode(",", $item->carta_identita);
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
                                <?php } ?>
                            </fieldset>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-coniuge" class="btn plus-text mt-20 p-0">

                                <span class="rounded-icon">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="/bootstrap-italia/svg/sprites.svg#it-plus-circle"></use>
                                    </svg>
                                </span>
                                <span class="">Aggiungi coniuge</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal it-dialog-scrollable fade" tabindex="-1" role="dialog" id="modal-cittadino" aria-labelledby="modal-cittadino-modal-title">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <?= $this->render("../../_form-upload-attachment", ["cittadino" => $cittadino]) ?>
    </div>
</div>

<div class="modal it-dialog-scrollable fade" tabindex="-1" role="dialog" id="modal-coniuge" aria-labelledby="modal-coniuge-modal-title">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <?= $this->render("_form-coniuge", ["model" => new Coniuge(), "cittadino" => $cittadino]) ?>
    </div>
</div>

<!-- Script -->
<script>
    function uploadAttachment() {
        var form = document.getElementById('cittadino-form');
        if (form) {
            form.submit();
        } else {
            console.error("Form non trovato!");
        }
    }
</script>