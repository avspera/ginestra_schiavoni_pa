<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ValutazioneServizio $model */

$this->title = 'Create Valutazione Servizio';
$this->params['breadcrumbs'][] = ['label' => 'Valutazione Servizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valutazione-servizio-create">

    <div class="card-wrapper">
        <div class="card">
            <div class="card-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>