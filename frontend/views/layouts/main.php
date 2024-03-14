<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Yii::getAlias("@web") ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Yii::getAlias("@web") ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::getAlias("@web") ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= Yii::getAlias("@web") ?>/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?= Yii::getAlias("@web") ?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header class="it-header-wrapper it-shadow">
        <div class="it-header-slim-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-slim-wrapper-content">
                            <a class="d-none d-lg-block navbar-brand" href="#">Provincia di Benenvento</a>
                            <div class="it-header-slim-right-zone">
                                <div class="it-access-top-wrapper">
                                    <a class="btn btn-xs btn-primary btn-sm" href="#">Accedi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="it-nav-wrapper">
            <div class="it-header-center-wrapper theme-light">
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
                                    <!-- <div class="it-search-wrapper">
                                        <span class="d-none d-md-block">Cerca</span>
                                        <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Cerca nel sito" data-focus-mouse="false">
                                            <svg class="icon">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
                                            </svg>
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="it-header-navbar-wrapper theme-light-desk">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!--start nav-->
                            <nav class="navbar navbar-expand-lg has-megamenu" aria-label="Navigazione principale">
                                <button class="custom-navbar-toggler" type="button" aria-controls="navC2" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-toggle="navbarcollapsible" data-bs-target="#navC2">
                                    <svg class="icon">
                                        <use href="/bootstrap-italia/svg/sprites.svg#it-burger"></use>
                                    </svg>
                                </button>
                                <div class="navbar-collapsable" id="navC2" style="display: none;">
                                    <div class="overlay" style="display: none;"></div>
                                    <div class="close-div">
                                        <button class="btn close-menu" type="button">
                                            <span class="visually-hidden">Nascondi la navigazione</span>
                                            <svg class="icon">
                                                <use href="/bootstrap-italia/svg/sprites.svg#it-close-big"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="menu-wrapper">
                                        <ul class="navbar-nav">
                                            <li class="nav-item active"><a class="nav-link <?= Yii::$app->controller->id == "albo-pretorio" ? "active" : "" ?>" href="<?= Url::to(["albo-pretorio/index"]) ?>" aria-current="page"><span>Albo pretorio</span></a></li>
                                            <li class="nav-item"><a class="nav-link <?= Yii::$app->controller->id == "atto-di-matrimonio" ? "active" : "" ?>" href="<?= Url::to(["atto-di-matrimonio/index"]) ?>" aria-disabled="true"><span>Pubblicazioni di Matrimonio</span></a></li>
                                            <li class="nav-item"><a class="nav-link <?= Yii::$app->controller->id == "contravvenzioni" ? "active" : "" ?>" href="<?= Url::to(["contravvenzioni/index"]) ?>"><span>Contravvenzioni</span></a></li>
                                            <li class="nav-item"><a class="nav-link <?= Yii::$app->controller->id == "parcheggio-residenti" ? "active" : "" ?>" href="<?= Url::to(["parcheggio-residenti/index"]) ?>"><span>Parcheggio residenti</span></a></li>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" id="actionsDropdown">
                                                    <span>Assistenza</span>
                                                    <svg class="icon icon-xs">
                                                        <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu" role="region" aria-labelledby="actionsDropdown">
                                                    <div class="link-list-wrapper">
                                                        <ul class="link-list">
                                                            <li><a class="dropdown-item list-item" href="<?= Url::to(["assistenza/index"]) ?>"><span>Le tue richieste</span></a></li>
                                                            <li><a class="dropdown-item list-item" href="<?= Url::to(["assistenza/create"]) ?>"><span>Richiedi online</span></a></li>
                                                            <li><a class="dropdown-item list-item" href="<?= Url::to(["richiesta-appuntamento/create"]) ?>"><span>Prenota appuntamento in sede</span></a></li>
                                                            <li><a class="dropdown-item list-item" href="<?= Url::to(["segnala-disservizio/create"]) ?>"><span>Segnala un disservizio</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <div class="breadcrumb-container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
            <?php if (Yii::$app->session->hasFlash("success")) {
                $flashMessage = YIi::$app->session->getFlash("success");
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $flashMessage ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">
                        <svg class="icon">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-close"></use>
                        </svg>
                    </button>
                </div>
            <?php } ?>

            <?php if (Yii::$app->session->hasFlash("warning")) {
                $flashMessage = YIi::$app->session->getFlash("warning");
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $flashMessage ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">
                        <svg class="icon">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-close"></use>
                        </svg>
                    </button>
                </div>
            <?php } ?>

            <?php if (Yii::$app->session->hasFlash("error")) {
                $flashMessage = YIi::$app->session->getFlash("error");
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $flashMessage ?>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">
                        <svg class="icon">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-close"></use>
                        </svg>
                    </button>
                </div>
            <?php } ?>
            <?= $content ?>
        </div>
    </main>


    <footer class="it-footer">
        <div class="it-footer-main">
            <div class="container">
                <section>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="it-brand-wrapper">
                                <!-- <a href="#" data-focus-mouse="false" class="">
                                    <svg class="icon">
                                        <use xlink:href="/bootstrap-italia/svg/sprites.svg#it-code-circle"></use>
                                    </svg>
                                    <div class="it-brand-text">
                                        <h2>Lorem Ipsum</h2>
                                        <h3 class="d-none d-md-block">Inserire qui la tag line</h3>
                                    </div>
                                </a> -->
                                <?= Html::img("/images/logo_ue.webp", ["style" => "width: 300px; height: 100%"]) ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="py-4 border-white border-top">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 pb-2">
                            <h4><a href="#" title="Vai alla pagina: Contatti">Contatti</a></h4>
                            <p>
                                <strong>Comune di Ginestra Degli Schiavoni</strong><br>
                                Via Porta Nuova 2 - 82020 Ginestra Degli Schiavoni
                            </p>
                            <p>
                                <span class="bold">PEC:</span> <a style="color:white" href="mailto:uff.amm.vo.moffa.ginestra@asmepec.it">uff.amm.vo.moffa.ginestra@asmepec.it</a><br>
                                <span class="bold">P.Iva:</span> 00688690627<br>
                                <span class="bold">C.F.:</span> 8000443062
                            </p>
                            <div class="link-list-wrapper">
                                <ul class="footer-list link-list clearfix">
                                    <li>
                                        <a class="list-item" href="#" title="Vai alla pagina: URP - Ufficio Relazioni con il Pubblico">URP - Ufficio Relazioni con il Pubblico</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 pb-2">
                            <div class="pb-2">
                                <h4><a href="#" title="Vai alla pagina: Seguici su">Seguici su</a></h4>
                                <ul class="list-inline text-left social">
                                    <li class="list-inline-item">
                                        <a class="p-2 text-white" href="#" target="_blank"><svg class="icon icon-sm icon-white align-top">
                                                <use xlink:href="/bootstrap-italia/svg/sprites.svg#it-facebook"></use>
                                            </svg><span class="visually-hidden">Facebook</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="it-footer-small-prints clearfix">
            <div class="container">
                <h3 class="visually-hidden">Sezione Link Utili</h3>
                <ul class="it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row">
                    <!-- <li class="list-inline-item"><a href="#" title="Note Legali">Media policy</a></li> -->
                    <li class="list-inline-item"><a href="#" title="Note Legali">Note legali</a></li>
                    <li class="list-inline-item"><a href="<?= Url::to(["site/privacy"]) ?>" title="Privacy-Cookies">Privacy policy</a></li>
                    <li class="list-inline-item"><a href="<?= Url::to(["site/map"]) ?>" title="Mappa del sito">Mappa del sito</a></li>
                    <li class="list-inline-item"><a href="<?= Url::to(["backend/login"]) ?>" title="Accedi all'area privata">Accedi all'area privata</a></li>
                </ul>
            </div>
        </div>

    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
