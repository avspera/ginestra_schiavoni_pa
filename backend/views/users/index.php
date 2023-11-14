<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Utenti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card-wrapper">
        <div class="card card-success">
            <div class="card-header">
                <?= Html::a('Aggiungi nuovo utente', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'nome',
                        'username',
                        'email:email',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return $model->getStatus();
                            },
                            'filter' => $searchModel->statusList
                        ],
                        [
                            'attribute' => 'role',
                            'value' => function ($model) {
                                return $model->getRole();
                            },
                            'filter' => $searchModel->roleList
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>