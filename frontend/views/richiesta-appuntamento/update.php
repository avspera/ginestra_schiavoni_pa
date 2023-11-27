<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\RichiestaAppuntamento $model */

$this->title = 'Update Richiesta Appuntamento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Richiesta Appuntamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="richiesta-appuntamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
