<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\ContravvenzioneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = !empty($tipoDovuto["out"]) ? $tipoDovuto["out"]["titolo"] : 'Contravvenzioni';
$descrizione = !empty($tipoDovuto["out"]) ? $tipoDovuto["out"]["descrizione"] : "Paga qui le sanzioni al codice della strada";
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

?>
<div class="contravvenzione-index">

    <div id="pre_auth" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <legend><?= $this->title ?></legend>

            <p><?= $descrizione ?></p>
            <p>
                E' possibile procedere effettuando l'accesso o direttamente dai link riportati su questa pagina.
            </p>
            <p>
                Procedendo senza autenticazione non sono disponibili tutte le funzioni riservate nella sezione privata, come la consultazione dello stato di avanzamento della richiesta.
            </p>

            <p class="text-center mt20 mb20"><a href="<?= Url::to(["site/login"]) ?>" class="btn btn-primary">Vai alla pagina di autenticazione</a></p>
            <p class="text-center mt20 mb20"><strong>Oppure</strong></p>
            <p class="text-center mt20 mb20">
                <a class="btn btn-primary" href="<?= Url::to(["contravvenzioni/create"]) ?>">Paga senza autenticazione</a>
            </p>

        </div>

    </div>

</div>