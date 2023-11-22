<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AnagraficaComune $model */

$this->title = 'Modifica Anagrafica Comune: ' . $model->comune;
$this->params['breadcrumbs'][] = [
    'label' => "Anagrafica Comune",
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];
?>
<div class="anagrafica-comune-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>