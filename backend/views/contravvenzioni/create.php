<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = 'Aggiungi Contravvenzione';
$this->params['breadcrumbs'][] = ['label' => 'Contravvenzioni', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contravvenzione-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body table-responsive">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>