<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Mappa del sito"
?>
<div id="portal_content">
    <div class="row">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-10">
                    <h3><?= $this->title ?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <ul>
                        <li><?= Html::a("Home", Url::to(["/"]), ["class" => "link"]) ?></li>
                        <ul>
                            <li><?= Html::a("Albo pretorio", Url::to(["albo-pretorio/index"]), ["class" => "link"]) ?></li>
                            <li><?= Html::a("Pubblicazioni di matrimonio", Url::to(["atto-di-matrimonio/index"]), ["class" => "link"]) ?></li>
                            <li><?= Html::a("Contravvenzioni", Url::to(["contravvenzioni/index"]), ["class" => "link"]) ?></li>
                            <li><?= Html::a("Parcheggio per residenti", Url::to(["parcheggio-residenti/index"]), ["class" => "link"]) ?></li>
                        </ul>
                        <li>Assistenza</li>
                        <ul>
                            <li><?= Html::a("Richiedi online", Url::to(["assistenza/create"]), ["class" => "link"]) ?></li>
                            <li><?= Html::a("Prenota appuntamento in sede", Url::to(["richiesta-appuntamento/create"]), ["class" => "link"]) ?></li>
                            <li><?= Html::a("Segnala un disservizio", Url::to(["segnala-disservizio/create"]), ["class" => "link"]) ?></li>
                        </ul>
                        <li><?= Html::a("Valutazione servizio", Url::to(["valutazione-servizio/create"])) ?></li>
                        <li>Note legali</li>
                        <li><?= Html::a("Privacy policy", Url::to(["site/privacy"])) ?></li>
                        <li><?= Html::a("Mappa del sito", Url::to(["site/map"])) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>