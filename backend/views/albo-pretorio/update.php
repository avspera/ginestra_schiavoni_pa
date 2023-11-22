<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */

$this->title = 'Modifica Albo Pretorio: ' . $model->id;
$this->params['breadcrumbs'][] = [
    'label' => "Albo pretorio",
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];
?>
<div class="albo-pretorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>