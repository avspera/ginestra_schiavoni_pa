<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Utenti';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
]; ?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body lightgrey-bg-c1">
                <?= Html::a('Aggiungi Nuovo', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
                <div class="row mt-3">
                    <div class="table table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
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
    </div>
</div>