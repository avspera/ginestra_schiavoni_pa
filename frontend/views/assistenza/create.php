<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assistenza $model */

$this->title = 'Nuova richiesta di Assistenza';
$this->params['breadcrumbs'][] = [
    'label' => 'Assistenza',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="assistenza-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'loggedUser' => $loggedUser
    ]) ?>

</div>