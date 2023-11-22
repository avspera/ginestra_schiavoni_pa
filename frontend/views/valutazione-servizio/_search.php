<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ValutazioneServizioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="valutazione-servizio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_cittadino') ?>

    <?= $form->field($model, 'nome_servizio') ?>

    <?= $form->field($model, 'overall_rating') ?>

    <?= $form->field($model, 'satisfaction_reason') ?>

    <?php // echo $form->field($model, 'angry_reason') 
    ?>

    <?php // echo $form->field($model, 'notes') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::a('Annulla', ['class' => 'btn btn-xs btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>