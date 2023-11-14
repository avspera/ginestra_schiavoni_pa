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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cittadino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card-wrapper">
        <div class="card card-success">
            <div class="card-header">
                <?= Html::a('Aggiungi cittadino', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'nome',
                        'cognome',
                        'data_di_nascita:date',
                        'comune_di_nascita',
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