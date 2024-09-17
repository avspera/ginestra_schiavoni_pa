<?php

use common\components\Utils;
use common\models\Veicolo;
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
                                                    <a class="nav-link active" href="#applicant-info">
                                                        <span>Richiedente</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#vehicles-info">
                                                        <span>Veicolo</span>
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

        <?php if (empty($cittadino->patente_di_guida)) { ?>
            <div class="cmp-warning-box border-start border-warning border-2 mb-50">
                <div class="warning-box-icon">
                    <svg class="icon icon-warning" aria-hidden="true">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-info-circle" xlink:href="/bootstrap-italia/svg/sprites.svg#it-warning"></use>
                    </svg>
                    <span class="t-alert title-small-semi-bold">ATTENZIONE</span>
                </div>
                <div class="d-flex">
                    <p class="description description-warning mb-1">Ci sono alcune informazioni mancanti o errate</p>
                </div>

                <ul>
                    <?php if (empty($cittadino->patente_di_guida)) { ?>
                        <li>
                            <a href="#applicant-warning" class="t-primary subtitle-small pb-1 pt-1">Richiedente - Documenti</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        <?php } ?>

        <div class="it-page-sections-container">
            <section class="it-page-section" id="applicant-info">
                <div class="cmp-card mb-40">
                    <div class="card has-bkg-grey shadow-sm">
                        <div class="card-header border-0 p-0 mb-lg-20">
                            <div class="d-flex">
                                <h2 class="title-xxlarge mb-1">Richiedente</h2>
                            </div>
                            <p class="subtitle-small mb-0">Informazione su di te</p>
                        </div>
                        <div class="card-body p-0">
                            <div class="cmp-info-button-card">
                                <div class="card p-3 p-lg-4">
                                    <div class="card-body p-0">
                                        <h3 class="big-title mb-0"><?= $cittadino->fullname ?></h3>
                                        <p class="card-info">Codice Fiscale <br> <span><?= $cittadino->codice_fiscale ?></span></p>

                                        <div class="accordion-item">
                                            <div class="accordion-header" id="heading-collapse-parents">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-parents" aria-expanded="true" aria-controls="collapse-parents">
                                                    <span class="d-flex align-items-center">
                                                        Mostra tutto
                                                        <svg class="icon icon-primary icon-sm">
                                                            <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="collapse-parents" class="accordion-collapse collapse show" role="region">
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

                                                                <?php if (!empty($item->patente_di_guida)) { ?>
                                                                    <div class="border-light">
                                                                        <p class="data-text">
                                                                            <?php
                                                                            $patente = explode(",", $item->patente_di_guida);
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
                                                                        <div class="text-paragraph-small">Patente auto</div>
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
                    </div>
                </div>
            </section>

            <section class="it-page-section" id="vehicles-info">
                <div class="cmp-card">
                    <div class="card has-bkg-grey shadow-sm">
                        <div class="card-header border-0 p-0 mb-lg-20">
                            <div class="d-flex">
                                <h2 class="title-xxlarge mb-1">Veicolo</h2>
                            </div>
                            <p class="subtitle-small mb-0">Seleziona o aggiungi il veicolo per il quale vuoi richiedere il permesso</p>
                        </div>
                        <div class="card-body p-0">

                            <fieldset>
                                <legend class="visually-hidden">Seleziona o aggiungi il veicolo per il quale vuoi richiedere il permesso
                                </legend>

                                <?php
                                $i = 0;
                                foreach ($vehicles as $item) { ?>
                                    <div class="cmp-info-button-card radio-card">
                                        <div class="card p-3 p-lg-4">
                                            <div class="card-header mb-0 p-0">
                                                <div class="form-check m-0">
                                                    <input <?= (!empty($model->veicolo) && $item->id == $model->veicolo) ? "checked" : "" ?>
                                                        value="<?= $item->id ?>"
                                                        class="radio-input"
                                                        name="ParcheggioResidenti[veicolo]"
                                                        type="radio"
                                                        id="parcheggioresidenti-id-<?= $item->id ?>">
                                                    <label for="parcheggioresidenti-id-<?= $item->id ?>">
                                                        <h3 class="big-title mb-0"><?= $item->marca . " " . $item->modello ?></h3>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <p class="card-info">Targa <br> <span><?= strtoupper($item->targa) ?></span></p>
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="heading-collapse-benef-<?= $item->id ?>">
                                                        <button class="collapsed accordion-button"
                                                            type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse-benef-<?= $item->id ?>"
                                                            aria-expanded="false"
                                                            aria-controls="collapse-benef-<?= $item->id ?>">
                                                            <span class="d-flex align-items-center">
                                                                Mostra tutto
                                                                <svg class="icon icon-primary icon-sm">
                                                                    <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div id="collapse-benef-<?= $item->id ?>" class="accordion-collapse collapse <?= (!empty($model->veicolo) && $item->id == $model->veicolo) ? "show" : "" ?>"
                                                        role="region">
                                                        <div class="accordion-body p-0">
                                                            <div class="cmp-info-summary bg-white border border-light p-3 p-lg-4">
                                                                <div class="card">
                                                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                                        <h4 class="title-large-semi-bold mb-3">Dati veicolo</h4>
                                                                        <a href="#" class="d-none text-decoration-none">
                                                                            <span class="text-button-sm-semi t-primary">Modifica</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="card-body p-0">
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Marca</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text"><?= $item->marca ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Modello</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text"><?= $item->modello ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Intestatario</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text"><?= $item->cittadino->fullname ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Tipo</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text"><?= $item->getTipoVeicolo() ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Targa</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text"><?= strtoupper($item->targa) ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="single-line-info border-light">
                                                                            <div class="text-paragraph-small">Relazione</div>
                                                                            <div class="border-light">
                                                                                <p class="data-text"><?= $item->getTipoRelazione() ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <?php if (empty($item->allegato_1)) { ?>
                                                                            <div class="single-line-info border-light" id="vehicles-warning">
                                                                                <div class="text-paragraph-small">Dichiarazione di concessione</div>
                                                                                <p class="fw-semibold data-text description-alert d-flex align-items-center border-light">
                                                                                    <span class="d-flex align-items-center">
                                                                                        <svg class="icon icon-sm icon-warning" aria-hidden="true">
                                                                                            <use href="/bootstrap-italia/svg/sprites.svg#it-error"></use>
                                                                                        </svg>
                                                                                        Documento mancante
                                                                                    </span>
                                                                                </p>
                                                                            </div>
                                                                        <?php } else { ?>
                                                                            <div class="single-line-info border-light">
                                                                                <div class="text-paragraph-small">Dichiarazione di concessione</div>
                                                                                <div class="border-light">
                                                                                    <p class="data-text">
                                                                                        <?php
                                                                                        $attachments_1 = explode(",", $item->allegato_1);
                                                                                        foreach ($attachments_1 as $attachment) {
                                                                                            echo substr($attachment, strrpos($attachment, "/") + 1) . ", ";
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
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="card-footer p-0">
                                                                        <?php if (empty($item->allegato_1)) { ?>
                                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-vehicle-data" class="btn btn-outline-primary w-100 mt-3">
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
                                <?php
                                    $i++;
                                }
                                ?>

                            </fieldset>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-vehicle" class="btn plus-text mt-20 p-0">

                                <span class="rounded-icon">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="/bootstrap-italia/svg/sprites.svg#it-plus-circle"></use>
                                    </svg>
                                </span>
                                <span class="">Aggiungi veicolo</span>
                            </button>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal it-dialog-scrollable fade" tabindex="-1" role="dialog" id="modal-cittadino" aria-labelledby="modal-vehicle-modal-title">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <?= $this->render("../../_form-upload-attachment", ["cittadino" => $cittadino]) ?>
    </div>
</div>

<div class="modal it-dialog-scrollable fade" tabindex="-1" role="dialog" id="modal-vehicle" aria-labelledby="modal-vehicle-modal-title">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <?= $this->render("../../_form-vehicle", ["model" => new Veicolo(), "cittadino" => $cittadino]) ?>
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