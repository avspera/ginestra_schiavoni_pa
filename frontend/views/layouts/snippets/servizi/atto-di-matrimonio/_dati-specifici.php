<?php

$datiSpecifici  = json_decode($datiSpecifici["data"], true);

$model->data_matrimonio     = $datiSpecifici["AttoDiMatrimonio"]["data_matrimonio"];
$model->luogo_matrimonio    = $datiSpecifici["AttoDiMatrimonio"]["luogo_matrimonio"];
$model->regime_matrimoniale = $datiSpecifici["AttoDiMatrimonio"]["regime_matrimoniale"];
$model->tipo_rito           = $datiSpecifici["AttoDiMatrimonio"]["tipo_rito"];

?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav
                class="navbar it-navscroll-wrapper navbar-expand-lg"
                aria-label="INFORMAZIONI RICHIESTE"
                data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                    <div class="menu-wrapper">
                        <div class="link-list-wrapper">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <span class="accordion-header" id="accordion-title-one">
                                        <button
                                            class="accordion-button pb-10 px-3"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-one"
                                            aria-expanded="true"
                                            aria-controls="collapse-one">
                                            INFORMAZIONI RICHIESTE
                                            <svg class="icon icon-xs right">
                                                <use
                                                    href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <div class="progress">
                                        <div
                                            class="progress-bar it-navscroll-progressbar"
                                            role="progressbar"
                                            aria-valuenow="0"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                            style="width: 0%"></div>
                                    </div>
                                    <div
                                        id="collapse-one"
                                        class="accordion-collapse collapse show"
                                        role="region"
                                        aria-labelledby="accordion-title-one">
                                        <div class="accordion-body">
                                            <ul class="link-list" data-element="page-index">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#durata-choice">
                                                        <span>Dati specifici</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#pagamento-choice">
                                                        <span>Tempi e costi</span>
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
                <p class="text-paragraph-small mb-40">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>

                <section class="it-page-section" id="durata-choice">

                    <div class="cmp-card mb-40">
                        <div class="card has-bkg-grey shadow-sm p-big">
                            <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                <div class="d-flex">
                                    <h2 class="title-xxlarge mb-1 icon-required">Dati specifici</h2>
                                </div>
                                <p class="subtitle-small mb-0 mb-4">Indica i dati specifici per il servizio richiesto</p>
                            </div>
                            <div class="card-body p-0">
                                <div class="cmp-card-radio">
                                    <div class="card card-teaser">
                                        <div class="card-body">

                                            <div class="mb-4">
                                                <div class="form-group cmp-input">
                                                    <label class="cmp-input__label active" for="attodimatrimonio-data_matrimonio">Data del matrimonio*</label>
                                                    <input type="date" class="form-control" id="attodimatrimonio-data_matrimonio" value="<?= $model->data_matrimonio ?>" name="AttoDiMatrimonio[data_matrimonio]" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="form-group cmp-input">
                                                    <label class="cmp-input__label active" for="attodimatrimonio-luogo_matrimonio">Luogo del matrimonio*</label>
                                                    <input type="text" class="form-control" id="attodimatrimonio-luogo_matrimonio" value="<?= $model->luogo_matrimonio ?>" name="AttoDiMatrimonio[luogo_matrimonio]" placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="select-wrapper">
                                                    <label for="attodimatrimonio-tipo_rito" class="">Tipo di rito*</label>
                                                    <select name="AttoDiMatrimonio[tipo_rito]" id="attodimatrimonio-tipo_rito" placeholder="Scegli" required>
                                                        <option value="">Scegli</option>
                                                        <?php foreach ($model->tipo_rito_choices as $key => $value) { ?>
                                                            <option <?= $model->tipo_rito == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="select-wrapper">
                                                    <label for="attodimatrimonio-regime_matrimoniale" class="">Regime matrimoniale*</label>
                                                    <select name="AttoDiMatrimonio[regime_matrimoniale]" id="attodimatrimonio-regime_matrimoniale" placeholder="Scegli" required>
                                                        <option value="">Scegli</option>
                                                        <?php foreach ($model->regime_matrimoniale_choices as $key => $value) { ?>
                                                            <option <?= $model->regime_matrimoniale == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="form-group cmp-input">
                                                    <label class="cmp-input__label active" for="attodimatrimonio-residenza">Residenza*</label>
                                                    <input type="date" class="form-control" id="attodimatrimonio-residenza" value="<?= $model->residenza ?>" name="AttoDiMatrimonio[residenza]" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <section class="it-page-section" id="pagamento-choice">
                    <div class="cmp-card mb-40">
                        <div class="card has-bkg-grey shadow-sm p-big">
                            <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                <div class="d-flex">
                                    <h2 class="title-xxlarge mb-1">Tempi e costi</h2>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="cmp-card-radio">
                                    <div class="card card-teaser">
                                        <div class="card-body">
                                            <p class="subtitle-small mb-0 mb-4">Il servizio non prevede alcun costo</p>
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