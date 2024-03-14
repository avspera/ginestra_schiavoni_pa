<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaReply $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assistenza Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assistenza-reply-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_assistenza',
            'messaggio:ntext',
            'created_by',
            'created_at',
        ],
    ]) ?>

    <div class="row" style="margin-top:10px;">
        <p class="text-center"><?= Html::a("Esprimi il tuo giudizio", Url::to(["valutazione-servizio/create"]), ["class" => "btn btn-success"]) ?></p>
    </div>
</div>