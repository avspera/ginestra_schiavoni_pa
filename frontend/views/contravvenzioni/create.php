<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = 'Paga Contravvenzione';
$this->params['breadcrumbs'][] = [
    'label' => 'Contravvenzioni',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{$this->title}</li>",
];
?>
<div class="contravvenzione-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>

</div>