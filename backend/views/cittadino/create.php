<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

$this->title = 'Aggiungi Cittadino';
$this->params['breadcrumbs'][] = ['label' => 'Cittadini', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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