<?php

use common\components\Utils;
use common\models\Veicolo;

$datiGenerali   = json_decode($steps[1]["data"], true);
$datiSpecifici  = json_decode($steps[2]["data"], true);
$model->durata  = $datiSpecifici["ParcheggioResidenti"]["durata"];

$veicolo        = Veicolo::find()->where(["id" => $datiGenerali["ParcheggioResidenti"]["veicolo"]])->one();

?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-8">

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
                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                    <div class="d-flex">
                        <h3 class="subtitle-large mb-4" id="applicant-info">Richiedente</h3>
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

        <div class="pt-3 pt-lg-0">
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
        </div>

        <h2 class="title-xxlarge mb-4 mt-40">Preferenze di servizio</h2>
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
                                            $dataEsito = new DateTime($today);
                                            $dataEsito->modify('+1 year');
                                            ?>
                                            <?= Utils::formatDate($today) . " - " . $dataEsito->format("d/m/Y")  ?>
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
    </div>
</div>