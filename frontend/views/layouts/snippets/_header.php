<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="Vai al portale {Regione Campania} - link esterno - apertura nuova scheda" title="Vai al portale {Regione Campania}">Regione Campania</a>
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                                    <span class="visually-hidden">Lingua attiva:</span>
                                    <span>ITA</span>
                                    <svg class="icon">
                                        <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="link-list-wrapper">
                                                <ul class="link-list">
                                                    <li><a class="dropdown-item list-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                                    <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-primary btn-icon btn-full" href="<?= Url::to([Yii::$app->user->isGuest ? "site/login" : "users/view", "id" => 1]) ?>" data-element="personal-area-login">
                                <span class="rounded-icon" aria-hidden="true">
                                    <svg class="icon icon-primary">
                                        <use xlink:href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-user"></use>
                                    </svg>
                                </span>
                                <span class="d-none d-lg-block"><?= Yii::$app->user->isGuest ? "Accedi all'area personale"  : Yii::$app->user->identity->name ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="/">
                                    <?= Html::img(Yii::getAlias("@web") . "/images/logo.webp", ["style" => "width: 50px; height: 100%"]) ?>
                                    <div class="it-brand-text" style="margin-left: 10px;">
                                        <div class="it-brand-title">Comune di Ginestra Degli Schiavoni</div>
                                        <div class="it-brand-tagline d-none d-md-block">Regione Campania</div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-md-flex">
                                    <span>Seguici su</span>
                                    <ul>
                                        <li>
                                            <a href="#" aria-label="Facebook" target="_blank">
                                                <svg class="icon">
                                                    <use href="/bootstrap-italia/svg/sprites.svg#it-facebook"></use>
                                                </svg>
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
        <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!--start nav-->
                        <div class="navbar navbar-expand-lg has-megamenu">
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-target="#nav4" data-bs-toggle="navbarcollapsible">
                                <svg class="icon">
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-burger"></use>
                                </svg>
                            </button>
                            <div class="navbar-collapsable" id="nav4">
                                <div class="overlay" style="display: none;"></div>
                                <div class="close-div">
                                    <button class="btn close-menu" type="button">
                                        <span class="visually-hidden">Nascondi la navigazione</span>
                                        <svg class="icon">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-close-big"></use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="menu-wrapper">
                                    <!-- <a href="/" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-pa"></use>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">Comune di Ginestra degli Schiavoni</div>
                                        </div>
                                    </a> -->
                                    <nav aria-label="Principale">
                                        <ul class="navbar-nav" data-element="main-navigation">
                                            <li class="nav-item">
                                                <a class="nav-link" href="amministrazione.html" data-element="management">
                                                    <span>Amministrazione</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="novita.html" data-element="news">
                                                    <span>Novità</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="servizi.html" data-element="all-services">
                                                    <span>Servizi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="eventi.html" data-element="live">
                                                    <span>Vivere il Comune</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <nav aria-label="Secondaria">
                                        <ul class="navbar-nav navbar-secondary">
                                            <li class="nav-item">
                                                <a class="nav-link" href="argomento.html">Tutti gli argomenti</a>
                                            </li>
                                        </ul>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>