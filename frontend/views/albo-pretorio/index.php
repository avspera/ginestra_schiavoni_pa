<?php

use yii\widgets\ListView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Albo Pretorio';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$models = $dataProvider->getModels();
$latestUpdate = !empty($models[count($models) -1]) ? Utils::formatDate($models[count($models) -1]->data_pubblicazione) : "N/A";

?>
<div class="albo-pretorio-index">

    <div class="container my-4">
        <div class="col-12 " style="min-height: 520px;">

            <div class="row">
                <div class="col-12">
                    <div class="text-start">
                        <h1>Albo Pretorio Online</h1>
                        <p class="text-start">Il Servizio Albo Pretorio on line è il mezzo con cui la Pubblica Amministrazione Locale può comunicare con i cittadini e le imprese, in quanto permette di rendere pubblici i bandi e al tempo stesso permette di ottemperare agli obblighi normativi di pubblicazione, interagendo con la collettività. <br>
                            La pubblicazione degli atti che devono essere portati a conoscenza del pubblico è stata da sempre effettuata attraverso l’affissione degli atti stessi in una serie di bacheche appese alle pareti dei corridoi del palazzo comunale in modo da assicurare la pubblicità degli atti medesimi. Questa modalità di pubblicazione imponeva necessariamente di doversi recare presso l’Albo Pretorio per poter conoscere le deliberazioni adottate dagli organi collegiali. Questa pratica è stata innovata radicalmente dal Comune, effettuando la pubblicazione anche attraverso il web e di conseguenza fornendo a tutti un servizio più semplice e innovativo per reperire gli atti di proprio interesse.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= $this->render("_search", ["model" => $searchModel, "latestUpdate" => $latestUpdate]) ?>
                </div>
            </div>

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
            ]); ?>

        </div>

        <div class="alert alert-secondary col-md-8 offset-md-2 mt-3 ps-3 pb-5 pb-md-3 bg-white" role="alert">
            Per leggere e stampare i documenti allegati in formato PDF è necessario Acrobat Reader versione 5 o superiore, scaricabile gratuitamente.
            <a class="float-end" href="http://www.adobe.it/products/acrobat/readstep2.html">
                <img alt="Download di Adobe Reader" src="<?= Yii::getAlias("@web") ?>/images/get_adobe_reader.gif">
            </a>
        </div>


    </div>
</div>