<?php

use common\models\Assistenza;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Richiesta Appuntamento';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
?>
<div class="assistenza-index">

    <div class="row">
        <div class="col-12">
            <div class="text-start">
                <h1>Richiesta appuntamento</h1>
                <p class="text-start">In questa sezione il cittadino può richiedere un appuntamento presso le varie sedi competenti del Comune, in base al motivo della richiesta.</p>
            </div>
        </div>
    </div>
    <div class="card-wrapper card-space">
        <div class="card card-bg no-after">
            <div class="card-body lightgrey-bg-c1">
                <?= Html::a('Aggiungi Nuovo', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
                <div class="row mt-3">
                    <div class="table table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'id',
                                'nome_richiedente',
                                'cognome_richiedente',
                                'email_richiedente:email',
                                'data',
                                //'sede_riferimento',
                                //'note:ntext',
                                //'attachments',
                                [
                                    'class' => ActionColumn::className(),
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>