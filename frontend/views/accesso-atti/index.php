<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\AccessoAttiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Accesso agli Atti';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
?>
<div class="atto-di-matrimonio-index">

    <div id="pre_auth" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <legend><?= $this->title ?></legend>

            <p>In questa sezione è possible richiedere l'accesso agli atti.</p>
            <p>
                E' possibile procedere effettuando l'accesso o direttamente dai link riportati su questa pagina.
            </p>
            <p>
                Procedendo senza autenticazione non sono disponibili tutte le funzioni riservate nella sezione privata, come la consultazione dello stato di avanzamento della richiesta.
            </p>

            <p class="text-center mt20 mb20"><a href="<?= Url::to(["accesso-atti/create"]) ?>" class="btn btn-primary">Vai alla pagina di autenticazione</a></p>

            <p class="text-center mt20 mb20">
                <strong>Oppure</strong><br><br>
                <a class="btn btn-primary" href="<?= Url::to(["accesso-agli-atti/create-no-login"]) ?>">Compila richiesta senza autenticazione</a>
            </p>

        </div>

    </div>

</div>