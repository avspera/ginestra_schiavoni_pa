<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

$this->title = 'Aggiungi Cittadino';
$this->params['breadcrumbs'][] = [
    'label' => "Cittadini",
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>".$this->title."</li>",
];
?>
<div class="cittadino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body table-responsive">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>