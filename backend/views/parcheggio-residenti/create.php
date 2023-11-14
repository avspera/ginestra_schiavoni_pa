<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$this->title = 'Create Parcheggio Residenti';
$this->params['breadcrumbs'][] = ['label' => 'Parcheggio Residentis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parcheggio-residenti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body table-responsive">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>