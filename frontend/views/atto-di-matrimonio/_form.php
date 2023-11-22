<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_coniuge_uno')->textInput() ?>

    <?= $form->field($model, 'id_coniuge_due')->textInput() ?>

    <?= $form->field($model, 'data_matrimonio')->textInput() ?>

    <?= $form->field($model, 'id_residenza')->textInput() ?>

    <?= $form->field($model, 'padre_coniuge_uno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'madre_coniuge_uno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'padre_coniuge_due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'madre_coniuge_due')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'tipo_rito')->textInput() ?>

    <?= $form->field($model, 'luogo_matrimonio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regime_matrimoniale')->textInput() ?>

    <?= $form->field($model, 'titolo_studio_coniuge_uno')->textInput() ?>

    <?= $form->field($model, 'titolo_studio_coniuge_due')->textInput() ?>

    <?= $form->field($model, 'posizione_professionale_coniuge_uno')->textInput() ?>

    <?= $form->field($model, 'posizione_professionale_coniuge_due')->textInput() ?>

    <?= $form->field($model, 'condizione_non_professionale_coniuge_uno')->textInput() ?>

    <?= $form->field($model, 'condizione_non_professionale_coniuge_due')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-xs btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
