<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaReply $model */

$this->title = 'Create Assistenza Reply';
$this->params['breadcrumbs'][] = ['label' => 'Assistenza Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assistenza-reply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
