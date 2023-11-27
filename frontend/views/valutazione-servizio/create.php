<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ValutazioneServizio $model */

$this->title = 'Valutazione Servizio';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];
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