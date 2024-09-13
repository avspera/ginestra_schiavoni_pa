<?php

use common\models\AccessoAtti;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ContravvenzioneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Accesso agli atti';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
?>
<div class="accesso-atti-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body lightgrey-bg-c1">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'numero_protocollo',
                        'id_cittadino',
                        'oggetto_richiesta:ntext',
                        'data_richiesta',
                        'stato_richiesta',
                        //'data_risposta',
                        //'note:ntext',
                        //'documento_rilasciato',
                        //'data_creazione',
                        //'data_aggiornamento',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, AccessoAtti $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>

</div>