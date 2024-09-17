<?php

use common\models\Cittadino;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CittadinoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cittadini';
$this->params['breadcrumbs'][] = [
    'label' => 'Cittadini',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="cittadino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body lightgrey-bg-c1">
                <?= Html::a('Aggiungi Nuovo', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
                <div class="table table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'id',
                            'nome',
                            'cognome',
                            'data_di_nascita:date',
                            'luogo_di_nascita',
                            //'documento_di_identita',
                            //'tipo_documento',
                            //'last_login',
                            //'email:email',
                            //'updated',
                            //'professione',
                            //'eta',
                            //'comune_di_residenza',
                            //'indirizzo_di_residenza',
                            //'cittadinanza',
                            //'stato_civile',
                            //'codice_fiscale',
                            //'telefono',
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, Cittadino $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>