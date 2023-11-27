<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SegnalazioneDisservizio $model */

$this->title = 'Segnala Disservizio';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
?>
<div class="segnalazione-disservizio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>