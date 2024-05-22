<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>
    <div class="skiplink">
        <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
        <a class="visually-hidden-focusable" href="#footer">Vai al
            footer</a>
    </div>

    <!-- <header class="it-header-wrapper it-shadow">
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
    </header> -->

    <?= $this->render("snippets/_header") ?>

    <main>
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

    <?= $this->render("snippets/_footer") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
