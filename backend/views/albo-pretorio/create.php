<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */

$this->title = 'Create Albo Pretorio';
$this->params['breadcrumbs'][] = ['label' => 'Albo Pretorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albo-pretorio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
