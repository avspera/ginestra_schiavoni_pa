<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Indirizzo $model */

$this->title = 'Create Indirizzo';
$this->params['breadcrumbs'][] = ['label' => 'Indirizzos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indirizzo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
