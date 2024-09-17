<?php

use common\components\Utils;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DI PAGINA" data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                    <div class="menu-wrapper">
                        <div class="link-list-wrapper">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <span class="accordion-header" id="accordion-title-one">
                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                            INDICE DI PAGINA
                                            <svg class="icon icon-xs right">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <div class="progress">
                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="91.79878048780488" aria-valuemin="0" aria-valuemax="100" style="width: 91.79878%;"></div>
                                    </div>
                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                        <div class="accordion-body">
                                            <ul class="link-list" data-element="page-index">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#latest-posts">
                                                        <span>Ultimi messaggi</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#latest-activities">
                                                        <span>Ultime attività</span>
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
        <div class="it-page-section mb-40 mb-lg-60" id="latest-posts">
            <div class="cmp-card">
                <div class="card">
                    <div class="card-header border-0 p-0 mb-lg-20">
                        <div class="d-flex">
                            <h2 class="title-xxlarge">Ultimi messaggi</h2>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php
                        foreach ($latest_messages as $item) {
                            $id = $item->id_model;

                            // Usa array_column e array_search per rendere il filtro più efficiente
                            $ids = array_column($latest_attivita, 'id');
                            $key = array_search($id, $ids);

                            if ($key !== false) {
                                $model = $latest_attivita[$key];
                        ?>
                                <div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="#modal-message" id="<?= $id ?>">
                                    <div class="card shadow-sm px-4 pt-4 pb-4">
                                        <span class="visually-hidden">Categoria:</span>
                                        <div class="card-header border-0 p-0 m-0">
                                            <time class="date-xsmall"><?= Utils::formatDate($model["date"]) ?></time>
                                        </div>
                                        <div class="card-body p-0 my-2">
                                            <h3 class="title-small-semi-bold t-primary m-0 mb-1">
                                                <?= Html::a($model["label"], Url::to([$model["url"], "id" => $id]), ["class" => "text-decoration-none"]) ?>
                                            </h3>
                                            <p class="text-paragraph text-truncate">La richiesta <?= isset($model["numero_protocollo"]) ? $model["numero_protocollo"] : $id ?> è in stato <?= Utils::getStatoRichiesta($model["stato_richiesta"]) ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                        <?php if (count($latest_messages) > 20) { ?>
                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                <span class="">Vedi altri messaggi</span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="it-page-section mb-50 mb-lg-90" id="latest-activities">
            <div class="cmp-card">
                <div class="card">
                    <div class="card-header border-0 p-0 mb-lg-20">
                        <div class="d-flex">
                            <h2 class="title-xxlarge mb-3">Ultime attività</h2>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php foreach ($latest_attivita as $item) { ?>
                            <div class="cmp-icon-card mb-3">
                                <div class="card pt-20 pb-4 ps-4 pr-30 drop-shadow">
                                    <div class="cmp-card-title d-flex">
                                        <svg class="icon icon-sm me-2" aria-hidden="true">
                                            <use href="/bootstrap-italia/svg/sprites.svg#it-files"></use>
                                        </svg>
                                        <h3 class="t-primary mb-2 title-small-semi-bold">
                                            <a href="<?= Url::to([$item["url"], "id" => $item["id"]]) ?>">
                                                <?= $item["label"] ?>
                                                <?php if (!empty($item["numero_protocollo"])) { ?>
                                                    <?= " - " . $item["numero_protocollo"] ?>
                                                <?php } ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="cmp-icon-card__description">
                                        <time class="date-xsmall ml-30"><?= Utils::formatDate($item["date"]) ?></time>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if (count($latest_attivita) > 20) { ?>
                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                <span class="">Vedi altre attività</span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>