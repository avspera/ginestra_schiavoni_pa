<?php

use common\models\AttoDiMatrimonio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Atto Di Matrimonios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atto-di-matrimonio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Atto Di Matrimonio', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_coniuge_uno',
            'id_coniuge_due',
            'data_matrimonio',
            'id_residenza',
            //'padre_coniuge_uno',
            //'madre_coniuge_uno',
            //'padre_coniuge_due',
            //'madre_coniuge_due',
            //'created_at',
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
