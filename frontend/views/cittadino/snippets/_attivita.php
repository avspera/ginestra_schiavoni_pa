<?php

use common\components\Utils;
use yii\helpers\Url;

?>
<div class="row">
    <div class="d-none d-sm-none d-lg-block col-lg-3">
        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-Three">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DI PAGINA" data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                    <div class="menu-wrapper">
                        <div class="link-list-wrapper">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <span class="accordion-header" id="accordion-title-Three">
                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Three" aria-expanded="true" aria-controls="collapse-Three">
                                            INDICE DI PAGINA
                                            <svg class="icon icon-xs right">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="91.79878048780488" aria-valuemin="0" aria-valuemax="100" style="width: 91.79878%;"></div>
                                    </div>
                                    <div id="collapse-Three" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-Three">
                                        <div class="accordion-body">
                                            <ul class="link-list" data-element="page-index">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#practices">
                                                        <span>Pratiche</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#payments">
                                                        <span>Pagamenti</span>
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
    <div class="col-12 col-lg-8 offset-lg-1 px-0 px-sm-3">
        <section class="it-page-section mb-40 mb-lg-60" id="practices">
            <div class="cmp-filter">
                <div class="filter-section">
                    <h2 class="cmp-filter__title title-xxlarge">Pratiche</h2>
                    <div class="filter-wrapper d-flex align-items-center">
                        <button type="button" class="btn p-0 pe-2 t-primary">
                            <span class="rounded-icon">
                                <svg class="icon icon-primary icon-xs me-1" aria-hidden="true">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-funnel"></use>
                                </svg>
                            </span>
                            <span class="">Filtra</span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu-pratiche" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                                <svg class="icon-expand icon icon-sm icon-primary">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                </svg>
                                <span class="dropdown__title">Ordina</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-pratiche">
                                <div class="link-list-wrapper">
                                    <ul class="link-list">
                                        <li><a class="dropdown-item list-item" href="#"><span>Data creazione (A->Z)</span></a></li>
                                        <li><a class="dropdown-item list-item" href="#"><span>Data creazione (Z->A)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper">
                        <div class="input-group">
                            <label for="autocomplete-pratiche" class="visually-hidden active">Cerca nel sito</label>
                            <input type="search" class="autocomplete form-control" placeholder="Cerca" id="autocomplete-pratiche" name="pratiche" data-bs-autocomplete="[]">
                            <ul class="autocomplete-list"></ul>
                            <span class="autocomplete-icon" aria-hidden="true">
                                <svg class="icon icon-sm">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cmp-accordion">
                <div class="accordion" id="">

                    <?php
                    $i = 1;
                    foreach ($items as $item) { ?>
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                    <div class="button-wrapper">
                                        <?php
                                        if (!empty($item["numero_protocollo"])) {
                                            echo $item["numero_protocollo"];
                                        } else {
                                            echo $item["id"];
                                        }
                                        ?>
                                        <?= " - " . $item["label"] ?>

                                        <div class="icon-wrapper">
                                            <?php
                                            $icons = Utils::getStatoRichiestaIcons($item["stato_richiesta"]);
                                            $stato_richiesta = Utils::getStatoRichiesta($item["stato_richiesta"]);
                                            ?>
                                            <img class="icon-folder icon-<?= $icons["class"] ?>" src="/bootstrap-italia/images/<?= $icons["image"] ?>" alt="folder <?= $stato_richiesta ?>" role="img">
                                            <span class="u-main-alert"><?= $stato_richiesta ?></span>
                                        </div>
                                    </div>
                                </button>
                                <p class="accordion-date title-xsmall-regular mb-0"><?= Utils::formatDate($item["date"]) ?></p>
                            </div>

                            <div id="collapse<?= $i ?>" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample<?= $i ?>" role="region" aria-labelledby="heading<?= $i ?>">
                                <div class="accordion-body">
                                    <?php if (!empty($item["numero_protocollo"])) { ?>
                                        <p class="mb-2 fw-normal">Pratica: <span class="label"><?= $item["numero_protocollo"] ?></span></p>
                                    <?php } ?>
                                    <a href="<?= Url::to([$item["url"], "id" => $item["id"]]) ?>" class="mb-2">
                                        <span class="t-primary">Scheda servizio</span>
                                    </a>
                                    <a class="chip chip-simple" href="#">
                                        <span class="chip-label"><?= $item["label"] ?></span>
                                    </a>

                                    <!-- <div class="cmp-icon-list">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list">
                                            <li class="shadow p-0">
                                                <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                    <span class="list-item-title-icon-wrapper">
                                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                            <use href="/bootstrap-italia/svg/sprites.svg#it-clip"></use>
                                                        </svg>
                                                        <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                    </span>
                                                </a>

                                            </li>
                                        </ul>
                                    </div>
                                </div> -->

                                    <!-- <button type="button" class="btn btn-primary justify-content-center my-3">
                                    <span class="">Paga ora</span>
                                </button> -->
                                </div>
                            </div>
                        </div>
                    <?php $i++;
                    } ?>
                </div>
            </div>
            <?php if (count($items) > 20) { ?>
                <button type="button" class="btn d-block accordion-view-more mb-2 pt-3 t-primary title-xsmall-semi-bold ps-lg-3">
                    <span class="">Vedi altre pratiche</span>
                </button>
            <?php } ?>
        </section>

        <section class="it-page-section mb-50 mb-lg-90" id="payments">
            <div class="cmp-filter">
                <div class="filter-section">
                    <h2 class="cmp-filter__title title-xxlarge">Pagamenti</h2>
                    <div class="filter-wrapper d-flex align-items-center">
                        <button type="button" class="btn p-0 pe-2 t-primary">
                            <span class="rounded-icon">
                                <svg class="icon icon-primary icon-xs me-1" aria-hidden="true">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-funnel"></use>
                                </svg>
                            </span>
                            <span class="">Filtra</span>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu-pagamenti" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                                <svg class="icon-expand icon icon-sm icon-primary">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                </svg>
                                <span class="dropdown__title">Ordina</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-pagamenti">
                                <div class="link-list-wrapper">
                                    <ul class="link-list">
                                        <li><a class="dropdown-item list-item" href="#"><span>Azione 1</span></a></li>
                                        <li><a class="dropdown-item list-item" href="#"><span>Azione 2</span></a></li>
                                        <li><a class="dropdown-item list-item" href="#"><span>Azione 3</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper">
                        <div class="input-group">
                            <label for="autocomplete-pagamenti" class="visually-hidden active">Cerca nel sito</label>
                            <input type="search" class="autocomplete form-control" placeholder="Cerca" id="autocomplete-pagamenti" name="pagamenti" data-bs-autocomplete="[]">
                            <ul class="autocomplete-list"></ul>


                            <span class="autocomplete-icon" aria-hidden="true">
                                <svg class="icon icon-sm">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cmp-accordion">
                <div class="accordion" id="">
                    <div class="accordion-item">
                        <div class="accordion-header" id="heading6">
                            <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                <div class="button-wrapper">
                                    Pagamento permesso ZTL
                                    <div class="icon-wrapper">

                                        <img class="icon-folder" src="/bootstrap-italia/images/folder-pay.svg" alt="folder Pagato" role="img">
                                        <span class="">Pagato</span>
                                    </div>
                                </div>
                            </button>
                            <p class="accordion-date title-xsmall-regular mb-0">04/03/2022</p>
                        </div>

                        <div id="collapse6" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample6" role="region" aria-labelledby="heading6">
                            <div class="accordion-body">
                                <p class="mb-2 fw-normal">Pagamento: <span class="label">PA3028/17</span></p>

                                <p class="mb-2 fw-normal">Metodo: <span class="label">PagoPA</span></p>
                                <p class="mb-2 fw-normal">Importo: <span class="label">16,00 €</span></p>

                                <a href="#" class="mb-2">
                                    <span class="t-primary">Scheda servizio</span>
                                </a>

                                <a class="chip chip-simple" href="#">
                                    <span class="chip-label">Richiesta permesso ZTL</span>
                                </a>

                                <div class="cmp-icon-list">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list">
                                            <li class="shadow p-0">
                                                <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta pagamento">
                                                    <span class="list-item-title-icon-wrapper">
                                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                            <use href="/bootstrap-italia/svg/sprites.svg#it-clip"></use>
                                                        </svg>
                                                        <span class="list-item-title title-small-semi-bold">Ricevuta pagamento</span>
                                                    </span>
                                                </a>

                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <button type="button" class="btn d-block accordion-view-more mb-2 t-primary title-xsmall-semi-bold ps-lg-3">
                <span class="">Vedi altri pagamenti</span>
            </button>
        </section>
    </div>

</div>