<?php

use common\models\ParcheggioResidenti;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidentiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Parcheggio Residenti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parcheggio-residenti-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aggiungi Parcheggio Residenti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'id_cittadino',
                'value' => function ($model) {
                    return Utils::getCittadino($model->id_cittadino);
                }
            ],
            'id_indirizzo',
            'qnt_auto',
            [
                'attribute' => "price",
                'value' => function ($model) {
                    return Utils::formatCurrency($model->price);
                }
            ],
            [
                'attribute' => 'payed',
                "value" => function ($model) {
                    return $model->payed ? "SI" : "NO";
                }
            ],
            'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ParcheggioResidenti $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>