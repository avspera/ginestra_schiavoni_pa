<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = 'Modifica Parcheggio Residenti: ' . $model->id;
$this->params['breadcrumbs'][] = [
    'label' => "Parcheggio Residenti",
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];

?>
<div class="parcheggio-residenti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>