<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var ActiveForm $form */
?>
<div class="contravvenzioni-_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'amount') ?>
        <?= $form->field($model, 'articolo_codice') ?>
        <?= $form->field($model, 'data_accertamento') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'targa') ?>
        <?= $form->field($model, 'created_by') ?>
        <?= $form->field($model, 'data_pagamento') ?>
        <?= $form->field($model, 'orario_accertamento') ?>
        <?= $form->field($model, 'punti_patente') ?>
        <?= $form->field($model, 'payed') ?>
        <?= $form->field($model, 'updated_by') ?>
        <?= $form->field($model, 'id_cittadino') ?>
        <?= $form->field($model, 'strumento') ?>
        <?= $form->field($model, 'rata') ?>
        <?= $form->field($model, 'luogo') ?>
        <?= $form->field($model, 'ricevuta_pagamento') ?>
        <?= $form->field($model, 'nome') ?>
        <?= $form->field($model, 'cognome') ?>
        <?= $form->field($model, 'via') ?>
        <?= $form->field($model, 'comune') ?>
        <?= $form->field($model, 'nazione') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'id_univoco_versamento') ?>
        <?= $form->field($model, 'civico') ?>
        <?= $form->field($model, 'prov') ?>
        <?= $form->field($model, 'cf') ?>
        <?= $form->field($model, 'cap') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- contravvenzioni-_form -->
