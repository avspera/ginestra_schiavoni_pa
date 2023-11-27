<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
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
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header class="it-header-wrapper it-shadow">
        <div class="it-nav-wrapper">
            <div class="it-header-center-wrapper theme-light">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="it-header-center-content-wrapper">
                                <div class="it-brand-wrapper">
                                    <a href="/">
                                        <?= Html::img(Yii::getAlias("@web") . "/images/logo.png", ["style" => "width: 50px;"]) ?>
                                        <div class="it-brand-text" style="margin-left: 10px;">
                                            <div class="it-brand-title">Comune di Ginestra Degli Schiavoni</div>
                                            <div class="it-brand-tagline d-none d-md-block">Regione Campania</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="it-right-zone">
                                    <div class="d-none d-md-flex">
                                        <?php
                                        if (Yii::$app->user->isGuest) {
                                            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
                                        } else {
                                            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                                                . Html::submitButton(
                                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                                    ['class' => 'btn btn-link logout text-decoration-none']
                                                )
                                                . Html::endForm();
                                        }
                                        ?>

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
                                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" id="mainNavDropdown0">
                                                    <span>Altro</span>
                                                    <svg class="icon icon-xs">
                                                        <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown0">
                                                    <div class="link-list-wrapper">
                                                        <ul class="link-list">
                                                            <li class="nav-item"><a class="nav-link <?= Yii::$app->controller->id == "cittadino" ? "active" : "" ?>" href="<?= Url::to(["cittadino/index"]) ?>"><span>Anagrafica cittadini</span></a></li>
                                                            <?php if (Yii::$app->user->identity->isAdmin()) : ?>
                                                                <li class="nav-item"><a class="nav-link <?= Yii::$app->controller->id == "anagrafica-comune" ? "active" : "" ?>" href="<?= Url::to(["anagrafica-comune/index"]) ?>"><span>Anagrafica Comune</span></a></li>
                                                            <?php endif; ?>
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
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
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
                    <strong>Attenzione</strong> <?= $flashMessage ?>.
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
                    <strong>Attenzione</strong> <?= $flashMessage ?>.
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

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end">Powered by Apps&Projects S.r.l.s</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
