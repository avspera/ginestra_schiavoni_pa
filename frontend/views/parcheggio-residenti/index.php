<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidentiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Parcheggio Residenti';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="parcheggio-residenti-index">

    <div id="pre_auth" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <legend><?= $this->title ?></legend>

            <p>In questa sezione è possible richiedere la pubblicazione dell'atto di matrimonio in Albo Pretorio.</p>
            <p>
                E' possibile procedere effettuando l'accesso o direttamente dai link riportati su questa pagina.
            </p>
            <p>
                Procedendo senza autenticazione non sono disponibili tutte le funzioni riservate nella sezione privata, come la consultazione dello stato di avanzamento della richiesta.
            </p>

            <p class="text-center mt20 mb20"><a href="<?= Url::to(["site/login"]) ?>" class="btn btn-primary">Vai alla pagina di autenticazione</a></p>

            <p class="text-center mt20 mb20">
                <strong>Oppure</strong><br><br>
                <a class="btn btn-primary" href="<?= Url::to(["parcheggio-residenti/create"]) ?>">Compila richiesta senza autenticazione</a>
            </p>

        </div>

    </div>

</div>