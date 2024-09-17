<?php

use yii\helpers\Url;

$this->title = "Richiesta #" . $model->numero_protocollo . " del " . \common\components\Utils::formatDate($model->created_at) . " inviata correttamente";

$this->params['breadcrumbs'][] = [
    'label' => 'Parcheggio per residenti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];

?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-10">

        <div class="cmp-heading pb-3 pb-lg-4">
            <div class="categoryicon-top d-flex">
                <svg class="icon icon-success mr-10 big-lg-icon mb-1" aria-hidden="true">
                    <use href="/bootstrap-italia/svg/sprites.svg#it-check-circle"></use>
                </svg>
                <h1 class="title-xxxlarge">Richiesta inviata</h1>
            </div>

            <p class="subtitle-small">Grazie abbiamo ricevuto la tua richiesta per la pratica <strong><?= $model->numero_protocollo ?></strong> Parcheggio per residenti</p>
            <p class="subtitle-smallpt-3 pt-lg-4 mb-0">Abbiamo inviato il riepilogo all’email: <br>
                <strong><?= $cittadino->email ?></strong>
            </p>

            <button type="button" class="btn btn-outline-primary fw-bold">
                <span class="rounded-icon">
                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-download"></use>
                    </svg>
                </span>
                <span class="">Scarica la ricevuta (PDF 100KB)</span>
            </button>
        </div>
    </div>
    <hr class="d-none d-lg-block mt-3 mb-40">
    <div class="row">
        <div class="d-none d-sm-none d-lg-block col-lg-3">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DELLA PAGINA" data-bs-navscroll="">
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                            <button class="accordion-button pb-10 px-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="false" aria-controls="collapse-one">
                                                INDICE DELLA PAGINA
                                                <svg class="icon icon-xs right">
                                                    <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                        <div id="collapse-one" class="accordion-collapse collapse" role="region" aria-labelledby="accordion-title-one" style="">
                                            <div class="accordion-body">
                                                <ul class="link-list" data-element="page-index">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#next-step">
                                                            <span>Prossimi passi</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#rate-service">
                                                            <span>Valuta il servizio</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#related-service">
                                                            <span>Servizi correlati</span>
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
            <div class="it-page-sections-container">
                <section class="it-page-section" id="next-step">
                    <div class="cmp-timeline">
                        <h2 class="title-xxlarge mb-3">Prossimi passi</h2>
                        <div class="calendar-vertical mb-3" data-element="service-calendar-list">
                            <div class="calendar-date">
                                <?php
                                $dataEsito = new DateTime($model->created_at);
                                $days = "30";
                                $dataEsito->modify('+' . $days . ' days');
                                $anno   = $dataEsito->format("Y");
                                $giorno = $dataEsito->format("d");
                                $mese   = $dataEsito->format("M");
                                ?>
                                <h3 class="calendar-date-day">
                                    <small class="calendar-date-day__year"><?= $anno ?></small>
                                    <span class="title-xxlarge-regular d-flex justify-content-center"><?= $giorno ?></span>
                                    <small class="calendar-date-day__month"><?= $mese ?></small>
                                </h3>
                                <div class="calendar-date-description rounded">
                                    <div class="calendar-date-description-content">
                                        <h4 class="h5 mb-0">Esito richiesta</h4>
                                        <p class="info-text mt-1 mb-0">Tra <?= $days ?> giorni ti comunicheremo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-4 mt-lg-30 mb-10"><a class="t-primary" href="<?= Url::to(["cittadino/view", "id" => $model->id_cittadino]) ?>">Consulta la richiesta</a> nella tua area riservata.</p>
                    </div>
                </section>

                <section class="it-page-section" id="related-service">
                    <div class="cmp-icon-list">
                        <h2 class="title-xxlarge mt-40 mb-2 mb-lg-4">Servizi correlati</h2>
                        <div class="link-list-wrapper">
                            <ul class="link-list">
                                <li class="shadow mb-50 mb-lg-80">
                                    <a class="list-item icon-left t-primary title-small-semi-bold" href="#">
                                        <span class="list-item-title-icon-wrapper">
                                            <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-settings"></use>
                                            </svg>
                                            <span class="list-item-title title-small-semi-bold">Richiedi pass residenti</span>
                                        </span>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>