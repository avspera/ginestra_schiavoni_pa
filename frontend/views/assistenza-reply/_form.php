<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AssistenzaReply $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assistenza-reply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_assistenza')->textInput() ?>

    <?= $form->field($model, 'messaggio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
