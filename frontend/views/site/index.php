<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="bg-grey-card">
        <div class="container">
            <div class="row">

                <div class="col-12 col-lg-8 pt-lg-50 pb-lg-50">

                    <p class="mb-4"><strong>4 </strong>servizi trovati in ordine alfabetico</p>

                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                                <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="#">Ambiente</a>
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["accesso-atti/index"]) ?>" class="text-decoration-none" data-element="service-link">Accesso agli atti</a></h3>
                                <p class="text-paragraph">Il servizio gestisce gli esposti e le segnalazioni riguardanti l'abbandono di rifiuti in aree
                                    private</p>
                            </div>
                        </div>
                    </div>

                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                                <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="#">Tributi, finanze e contravvenzioni</a>
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["contravvenzioni/index"]) ?>" class="text-decoration-none" data-element="service-link">Pagamento contravvenzione</a></h3>
                                <p class="text-paragraph">Pagamento delle contravvenzioni della Polizia Municipale</p>
                            </div>
                        </div>
                    </div>

                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                                <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="#">Mobilità e trasporti</a>
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["parcheggio-residenti/index"]) ?>" class="text-decoration-none" data-element="service-link">Permesso sosta per residenti</a></h3>
                                <p class="text-paragraph">Servizio di richiesta di parcheggio e sosta per i residenti sul territorio comunale</p>
                            </div>
                        </div>
                    </div>

                    <div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                                <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="<?= Url::to(["atto-di-matrimonio/index"]) ?>">Anagrafe e stato civile</a>
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="#" class="text-decoration-none" data-element="service-link">Pubblicazione atto di matrimonio</a></h3>
                                <p class="text-paragraph">Richiesta di pubblicazione dell'atto di matrimonio nell'albo pretorio</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-lg-4 pt-30 pt-lg-5 ps-lg-5 order-first order-md-last">
                    <div class="link-list-wrap">
                        <h2 class="title-xsmall-semi-bold"><span>SERVIZI IN EVIDENZA</span></h2>
                        <ul class="link-list t-primary">
                            <li class="mb-3 mt-3">
                                <a class="list-item ps-0 title-medium" href="<?= Url::to(["accesso-atti/index"]) ?>">
                                    <span>Accesso agli atti</span>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a class="list-item ps-0 title-medium" href="<?= Url::to(["atto-di-matrimonio/index"]) ?>">
                                    <span>Pubblicazione atti di matrimonio</span>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a class="list-item ps-0 title-medium" href="<?= Url::to(["contravvenzioni/index"]) ?>">
                                    <span>Pagameneto contravvenzioni</span>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a class="list-item ps-0 title-medium" href="<?= Url::to(["parcheggio-residenti/index"]) ?>">
                                    <span>Richiesta parcheggio per residenti</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>