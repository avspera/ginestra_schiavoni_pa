<?php

use common\models\Assistenza;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Assistenza';
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
                <h1>Assistenza</h1>
                <p class="text-start">In questa sezione il cittadino può richiedere assistenza per i servizi digitali messi a disposizione dalla piattaforma del Comune.</p>
                <p>Prima di procedere a creare una nuova richiesta di assistenza, si invita il cittadino a consultare la sezione F.A.Q. (Frequently Asked Questions - Domande poste frequentemente) dove potrà già trovare risposte ai problemi più comuni. <br />Qualora il problema non sia risolto così, si invita il cittadino a compilare il modulo seguente e inoltrare una richiesta di assistenza direttamente all'ufficio comunale preposto.</p>
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
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'id',
                                'nome_richiedente',
                                'cf_richiedente',
                                'email_richiedente',
                                [
                                    'attribute' => 'motivo_richiesta',
                                    'value' => function ($model) {
                                        return $model->getMotivoRichiesta();
                                    }
                                ],
                                [
                                    'attribute' => 'stato_richiesta',
                                    'value' => function ($model) {
                                        return $model->getStatoRichiesta();
                                    }
                                ],
                                //'created_at',
                                //'updated_at',
                                //'updated_by',
                                //'note:ntext',
                                [
                                    'class' => ActionColumn::className(),
                                    'template' => "{view}"
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>