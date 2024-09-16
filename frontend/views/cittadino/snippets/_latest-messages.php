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

                        foreach ($items as $item) {
                            $id = $item->id_model;
                            $model = array_filter($latest_attivita, function ($elemento) use ($id) {
                                return $elemento['id'] == $id;
                            });
                            $model = reset($model);

                        ?>
                            <div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="#modal-message" id="<?= $id ?>">
                                <div class="card shadow-sm px-4 pt-4 pb-4">
                                    <span class="visually-hidden">Categoria:</span>
                                    <div class="card-header border-0 p-0 m-0">
                                        <date class="date-xsmall"><?= Utils::formatDate($model["date"]) ?></date>
                                    </div>
                                    <div class="card-body p-0 my-2">
                                        <h3 class="title-small-semi-bold t-primary m-0 mb-1">
                                            <?= Html::a($model["label"], Url::to([$model["url"], "id" => $id]), ["class" => "text-decoration-none"]) ?>
                                        </h3>
                                        <p class="text-paragraph text-truncate">La richiesta <?= isset($model["numero_protocollo"]) ? $model["numero_protocollo"] : $id  ?> è in stato <?= Utils::getStatoRichiesta($model["stato_richiesta"]) ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (count($items) > 20) {
                            ?>
                                <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                    <span class="">Vedi altri messaggi</span>
                                </button>
                            <?php } ?>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>