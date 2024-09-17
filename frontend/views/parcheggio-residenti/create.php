<?php

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = 'Richiedi Parcheggio Residenti';
$this->params['breadcrumbs'][] = [
    'label' => 'Servizi',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => 'Parcheggio per residenti',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item active'><span class='separator'>/</span>{$this->title}</li>",
];
?>
<div class="parcheggio-residenti-create">

    <?= $this->render('_form', [
        'model' => $model,
        'cittadino' => $cittadino,
        'vehicles' => $vehicles,
        'steps' => $steps
    ]) ?>

</div>