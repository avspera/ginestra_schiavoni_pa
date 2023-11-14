<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

$this->title = 'Modifica Cittadino: ' . $model->nome." ".$model->cognome;
$this->params['breadcrumbs'][] = ['label' => 'Cittadini', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome." ".$model->cognome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modifica';
?>
<div class="cittadino-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
