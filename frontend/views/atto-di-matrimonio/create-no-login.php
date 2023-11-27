<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = 'Nuovo Atto Di Matrimonio';
$this->params['breadcrumbs'][] = [
    'label' => 'Atto di matrimonio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{$this->title}</li>",
];
?>
<div class="atto-di-matrimonio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>