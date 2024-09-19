<?php

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = 'Richiedi Pubblicazione Atto di Matrimonio';
$this->params['breadcrumbs'][] = [
    'label' => 'Servizi',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => 'Pubblicazione Atti di Matrimonio',
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
        'steps' => $steps,
        'coniuge' => $coniuge
    ]) ?>

</div>