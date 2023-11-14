<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = 'Aggiungi nuovo Utente';
$this->params['breadcrumbs'][] = ['label' => 'Utenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <div class="card-body table-responsive">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>