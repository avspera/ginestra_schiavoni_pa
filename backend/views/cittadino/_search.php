<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CittadinoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cittadino-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'cognome') ?>

    <?= $form->field($model, 'data_di_nascita') ?>

    <?= $form->field($model, 'comune_di_nascita') ?>

    <?php // echo $form->field($model, 'documento_di_identita') ?>

    <?php // echo $form->field($model, 'tipo_documento') ?>

    <?php // echo $form->field($model, 'last_login') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'professione') ?>

    <?php // echo $form->field($model, 'eta') ?>

    <?php // echo $form->field($model, 'comune_di_residenza') ?>

    <?php // echo $form->field($model, 'indirizzo_di_residenza') ?>

    <?php // echo $form->field($model, 'cittadinanza') ?>

    <?php // echo $form->field($model, 'stato_civile') ?>

    <?php // echo $form->field($model, 'codice_fiscale') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-xs btn-primary']) ?>
        <?= Html::a('Reset', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
