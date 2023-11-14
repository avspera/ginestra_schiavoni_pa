<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Utils;

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <h3 class="profile-username text-center"><?= $model->nome ?></h3>
                <p class="text-muted text-center"><?= $model->getRole() ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Aggiunto da</b>: <a href="<?= Url::to(["users/view", "id" => $model->created_by]) ?>" class="float-right"><?= Utils::getCreatedBy($model->created_by) ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Stato</b>: <?= $model->getStatus() ?>
                    </li>
                </ul>

                <hr>

                <?php if (Yii::$app->user->identity->isAdmin()) { ?>
                    <?= Html::a("Nuova password", Url::to(['send-credentials', 'id' => $model->id]), ["class" => "btn btn-sm btn-primary btn-block m-1"]) ?>
                    <?= Html::a($model->status == $model::STATUS_INACTIVE ? "Attiva" : "Disattiva", Url::to(['set-status', 'id' => $model->id]), ["class" => "btn btn-sm btn-warning btn-block m-1"]) ?>
                    <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-danger btn-block m-1',
                        'data' => [
                            'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php } ?>
            </div>

        </div>

    </div>

    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header p-2">
                <h3>Info account</h3>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'nome',
                        'username',
                        'email:email',
                        [
                            'attribute' => 'role',
                            'value' => function ($model) {
                                return $model->getRole();
                            },
                        ],
                        'created_at:date',
                        'updated_at:date',
                        'last_login:datetime'
                    ],
                ]) ?>
            </div>
        </div>

    </div>

</div>