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

<body class="d-flex flex-column h-100 home blog">
    <?php $this->beginBody() ?>
    <div class="skiplink">
        <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
        <a class="visually-hidden-focusable" href="#footer">Vai al
            footer</a>
    </div>

    <?= $this->render("snippets/_header") ?>

    <main>
        <div class="container" id="main-container">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                        </nav>
                    </div>
                    <?php if (Yii::$app->session->hasFlash("success")) {
                        $flashMessage = YIi::$app->session->getFlash("success");
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $flashMessage ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso">
                                <svg class="icon">
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-close"></use>
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
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-close"></use>
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
                                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-close"></use>
                                </svg>
                            </button>
                        </div>
                    <?php } ?>
                    <?= $content ?>
                </div>

            </div>
        </div>

        <?php $this->render("snippets/_help") ?>
    </main>

    <?= $this->render("snippets/_footer") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
