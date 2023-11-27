<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaReply $model */

$this->title = 'Update Assistenza Reply: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Assistenza Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assistenza-reply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
