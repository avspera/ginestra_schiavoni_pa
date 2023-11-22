<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_coniuge_uno') ?>

    <?= $form->field($model, 'id_coniuge_due') ?>

    <?= $form->field($model, 'data_matrimonio') ?>

    <?= $form->field($model, 'id_residenza') ?>

    <?php // echo $form->field($model, 'padre_coniuge_uno') ?>

    <?php // echo $form->field($model, 'madre_coniuge_uno') ?>

    <?php // echo $form->field($model, 'padre_coniuge_due') ?>

    <?php // echo $form->field($model, 'madre_coniuge_due') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'tipo_rito') ?>

    <?php // echo $form->field($model, 'luogo_matrimonio') ?>

    <?php // echo $form->field($model, 'regime_matrimoniale') ?>

    <?php // echo $form->field($model, 'titolo_studio_coniuge_uno') ?>

    <?php // echo $form->field($model, 'titolo_studio_coniuge_due') ?>

    <?php // echo $form->field($model, 'posizione_professionale_coniuge_uno') ?>

    <?php // echo $form->field($model, 'posizione_professionale_coniuge_due') ?>

    <?php // echo $form->field($model, 'condizione_non_professionale_coniuge_uno') ?>

    <?php // echo $form->field($model, 'condizione_non_professionale_coniuge_due') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-xs btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
