<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\IndirizzoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="indirizzo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_cittadino') ?>

    <?= $form->field($model, 'id_atto_matrimonio') ?>

    <?= $form->field($model, 'via') ?>

    <?= $form->field($model, 'civico') ?>

    <?php // echo $form->field($model, 'cap') ?>

    <?php // echo $form->field($model, 'citta') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::a('Reset', Url::to(["index"]),['class' => 'btn btn-xs btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
