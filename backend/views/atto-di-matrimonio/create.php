<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = 'Aggiungi Atto Di Matrimonio';
$this->params['breadcrumbs'][] = [
    'label' => "Atti di matrimonio",
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];
?>
<div class="atto-di-matrimonio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body table-responsive">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>