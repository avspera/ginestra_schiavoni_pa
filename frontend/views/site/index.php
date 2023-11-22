<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="container">
       
        <div class="body-content" style="margin-top:10px">

            <div class="row">
                <div class="col-md-6">
                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["albo-pretorio/index"]) ?>" class="text-decoration-none" data-element="service-link">Albo Pretorio </a></h3>
                                <p class="text-paragraph">In questa sezione puoi consultare l'albo pretorio del Comune</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["atto-di-matrimonio/index"]) ?>" class="text-decoration-none" data-element="service-link">Pubblicazioni di Matrimonio</a></h3>
                                <p class="text-paragraph">In questa sezione puoi inoltrare la richiesta di pubblicazione di matrimonio.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["contravvenzioni/index"]) ?>" class="text-decoration-none" data-element="service-link">Contravvenzioni</a></h3>
                                <p class="text-paragraph">In questa sezione puoi pagare le contravvenzioni della Polizia Municipale.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#">
                        <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                            <span class="visually-hidden">Categoria:</span>
                            <div class="card-header border-0 p-0">
                            </div>
                            <div class="card-body p-0 my-2">
                                <h3 class="green-title-big t-primary mb-8"><a href="<?= Url::to(["parcheggio-residenti/index"]) ?>" class="text-decoration-none" data-element="service-link">Parcheggio residenti</a></h3>
                                <p class="text-paragraph">In questa sezione puoi fare richiesta di contrassegno del parcheggio per residenti.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>