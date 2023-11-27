<?php

use yii\helpers\Html;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\Assistenza $model */

$this->title = 'Modifica richiesta di assistenza: ' . $model->id . " del " . Utils::formatDate($model->created_at);
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
<div class="assistenza-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>