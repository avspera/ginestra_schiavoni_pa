<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = 'Aggiungi Atto Di Matrimonio';
$this->params['breadcrumbs'][] = ['label' => 'Atti Di Matrimoni', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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