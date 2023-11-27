<?php

use common\models\AssistenzaReply;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaReplySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Assistenza Replies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assistenza-reply-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assistenza Reply', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_assistenza',
            'messaggio:ntext',
            'created_by',
            'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AssistenzaReply $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    
</div>
