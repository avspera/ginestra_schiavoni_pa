<?php

use common\models\AttoDiMatrimonio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Atti Di Matrimonio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atto-di-matrimonio-index">
    
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card card-success" style="margin-top:10px;">
        <div class="card-header"><?= Html::a('Aggiungi Atto Di Matrimonio', ['create'], ['class' => 'btn btn-success']) ?></div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'id_coniuge_uno',
                    'id_coniuge_due',
                    'data_matrimonio:date',
                    'created_at:datetime',
                    //'updated_at',
                    //'created_by',
                    //'updated_by',
                    //'tipo_rito',
                    //'luogo_matrimonio',
                    //'regime_matrimoniale',
                    //'titolo_studio_coniuge_uno',
                    //'titolo_studio_coniuge_due',
                    //'posizione_professionale_coniuge_uno',
                    //'posizione_professionale_coniuge_due',
                    //'condizione_non_professionale_coniuge_uno',
                    //'condizione_non_professionale_coniuge_due',
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, AttoDiMatrimonio $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>