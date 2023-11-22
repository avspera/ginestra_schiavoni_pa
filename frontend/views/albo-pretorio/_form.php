<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="albo-pretorio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero_atto')->textInput() ?>

    <?= $form->field($model, 'anno')->textInput() ?>

    <?= $form->field($model, 'id_tipologia')->textInput() ?>

    <?= $form->field($model, 'numero_affissione')->textInput() ?>

    <?= $form->field($model, 'data_pubblicazione')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'attachments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
