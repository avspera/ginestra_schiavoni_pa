<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

$this->registerJsFile(
    '@web/spid/js/spid-idps.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/spid/js/spid-sp-access-button.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

$this->title = "Accedi"
?>
<link href="<?= Yii::getAlias('@web') ?>/spid/css/spid-sp-access-button.min.css" rel="stylesheet">
<div class="site-login">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="homepage.html">Home</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item active" aria-current="page">Accedi</li>
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading pb-3 pb-lg-4">
                <h1 class="title-xxxlarge">Accedi</h1>
                <p class="subtitle-small">Per accedere al sito e ai suoi servizi, utilizza una delle seguenti modalità.</p>
            </div>
        </div>
    </div>
    <hr class="d-none d-lg-block mt-0 mb-4">
    <?= $this->render("../layouts/snippets/servizi/_accesso") ?>
</div>