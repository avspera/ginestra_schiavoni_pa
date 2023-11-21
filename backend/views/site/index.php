<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->name;

/** @var yii\web\View $this */
?>
<div class="site-index">

    <div class="container">
        <div class="jumbotron text-center bg-transparent">
            <h1 class="display-4">Comune di Ginestra degli Schiavoni</h1>

            <p class="lead">Gestione telematica</p>

            <?= Html::img(Yii::getAlias("@web") . "/images/logo.png") ?>
        </div>

        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Atti - Albo pretorio</h2>

                    <p class="text-justify">In questa sezione puoi gestire l'albo pretorio del Comune</p>

                    <p><a class="btn btn-outline-secondary" href="<?= Url::to(["atti/index"]) ?>">Vedi tutti &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Matrimoni</h2>

                    <p class="text-justify">In questa sezione puoi gestire le richieste di tutti i cittadini che hanno fatto richiesta di pubblicazione di matrimonio.</p>

                    <p><a class="btn btn-outline-secondary" href="<?= Url::to(["atti-di-matrimonio/index"]) ?>">Vedi tutti &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Parcheggio residenti</h2>

                    <p class="text-justify">In questa sezione puoi gestire le richieste dei cittadini residenti che hanno richiesto il parcheggio per residenti.</p>

                    <p><a class="btn btn-outline-secondary" href="<?= Url::to(["parcheggio-residenti/index"]) ?>">Vedi tutti &raquo;</a></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <h2>Multe</h2>

                    <p class="text-justify">In questa sezione puoi gestire le contravvenzioni recapitate ai cittadini.</p>

                    <p><a class="btn btn-outline-secondary" href="<?= Url::to(["contravvenzioni/index"]) ?>">Vedi tutti &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Anagrafica Cittadini</h2>

                    <p class="text-justify">In questa sezione puoi gestire l'anagrafica di tutti i cittadini che hanno interagito con la piattaforma telematica.</p>
                    <p><a class="btn btn-outline-secondary" href="<?= Url::to(["cittadino/index"]) ?>">Vedi tutti &raquo;</a></p>
                </div>
                <?php if (Yii::$app->user->identity->isAdmin()) { ?>
                    <div class="col-lg-4">
                        <h2>Anagrafica Utenti</h2>

                        <p class="text-justify">In questa sezione puoi gestire tutti gli utenti che hanno accesso al lato amministrativo (questo) della piattaforma telematica.</p>

                        <p><a class="btn btn-outline-secondary" href="<?= Url::to(["users/index"]) ?>">Vedi tutti &raquo;</a></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>