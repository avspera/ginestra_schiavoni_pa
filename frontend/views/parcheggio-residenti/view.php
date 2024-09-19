<?php

use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = $model->id . " di " . $cittadino->fullname;
$this->params['breadcrumbs'][] = [
    'label' => 'Parcheggio residenti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];

$veicolo        = \common\models\Veicolo::find()->where(["id" => $model->veicolo])->one();
?>
<div class="row justify-content-center">
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
                                                    <a class="nav-link" href="#vehicle-info">
                                                        <span>Veicolo</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#service-info">
                                                        <span>Preferenze di servizio</span>
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
            <section class="it-page-section" id="applicant-info">
                <h2 class="title-xxlarge mb-4">Dati Generali</h2>
                <div class="cmp-card mb-4">
                    <div class="card has-bkg-grey shadow-sm mb-0 ">
                        <div class="card-header border-0 p-0 mb-lg-20 m-0">
                            <div class="d-flex">
                                <h3 class="subtitle-large mb-4">Richiedente</h3>
                            </div>
                        </div>
                        <div class="card-body p-0">

                            <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-3 p-lg-4">
                                <div class="card">

                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                        <h4 class="title-large-semi-bold mb-3"><?= $cittadino->fullname ?></h4>
                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                    </div>

                                    <div class="card-body p-0">
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
                                                    <?= $cittadino->data_di_nascita ?>
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
                            <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-3 p-lg-4">
                                <div class="card">

                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                        <h4 class="title-large-semi-bold mb-3">Indirizzo</h4>
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
                            <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-3 p-lg-4">
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
                            <div class="cmp-info-summary bg-white p-3 p-lg-4 mb-0">
                                <div class="card">

                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                        <h4 class="title-large-semi-bold mb-3">Documenti</h4>
                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Patente auto</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?php if (!empty($cittadino->patente_di_guida)) {
                                                        $patente = explode(",", $cittadino->patente_di_guida);  // Corretto "patante_di_guida"
                                                        foreach ($patente as $pt) {
                                                            echo substr($pt, strrpos($pt, "/") + 1);
                                                        }
                                                    }
                                                    ?>
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
            <section class="it-page-section" id="vehicle-info">

                <div class="cmp-card mb-4">
                    <div class="card has-bkg-grey shadow-sm mb-0">
                        <div class="card-header border-0 p-0 mb-lg-20">
                            <div class="d-flex">
                                <h3 class="subtitle-large mb-0" id="vehicle">Veicolo</h3>
                            </div>
                        </div>
                        <div class="card-body p-0">

                            <div class="cmp-info-summary bg-white p-3 p-lg-4">
                                <div class="card">

                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                        <h4 class="title-large-semi-bold mb-3"><?= $veicolo->marca . " " . $veicolo->modello ?></h4>
                                        <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Intestatario</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= $cittadino->fullname ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Tipo</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= $veicolo->getTipoVeicolo(); ?>
                                                </p>



                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Targa</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= strtoupper($veicolo->targa) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Relazione</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= $veicolo->getTipoRelazione(); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Dichiarazione di concessione</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?php
                                                    $patente = explode(",", $veicolo->allegato_1);
                                                    foreach ($patente as $pt) {
                                                        echo substr($pt, strrpos($pt, "/"));
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Libretto di circolazione</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?php
                                                    $patente = explode(",", $veicolo->allegato_2);
                                                    foreach ($patente as $pt) {
                                                        echo substr($pt, strrpos($pt, "/"));
                                                    }
                                                    ?>
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
            <section class="it-page-section" id="service-info">

                <h2 class="title-xxlarge mb-4 mt-40">Preferenze di servizio</h2>
                <div class="cmp-card">
                    <div class="card has-bkg-grey shadow-sm">
                        <div class="card-body p-0">

                            <div class="cmp-info-summary bg-white p-3 p-lg-4">
                                <div class="card">

                                    <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                        <h4 class="title-large-semi-bold mb-3">Parcheggio per residenti</h4>
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
                                                    <?= !empty($model->data_scadenza) ? Utils::formatDate($model->data_scadenza) : " - " ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Data richiesta</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= Utils::formatDate($model->created_at) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Stato richiesta</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= Utils::getStatoRichiesta($model->stato_richiesta) ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Numero di protocollo</div>
                                            <div class="border-light">
                                                <p class="data-text">
                                                    <?= !empty($model->numero_protocollo) ? $model->numero_protocollo : "-" ?>
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