<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = 'Create Atto Di Matrimonio';
$this->params['breadcrumbs'][] = ['label' => 'Atto Di Matrimonios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atto-di-matrimonio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
