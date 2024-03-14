<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = 'Richiedi Parcheggio Residenti';
$this->params['breadcrumbs'][] = [
    'label' => 'Parcheggio residenti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="parcheggio-residenti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'loggedUser' => $loggedUser
    ]) ?>

</div>