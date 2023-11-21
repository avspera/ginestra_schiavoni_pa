<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="albo-pretorio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'id') ?></div>
        <div class="col-md-3"><?= $form->field($model, 'numero_atto') ?></div>
        <div class="col-md-3"><?= $form->field($model, 'numero_affissione') ?></div>
        <div class="col-md-2"><?= $form->field($model, 'anno') ?></div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label>Tipologia</label>
            <?= $form->field($model, 'id_tipologia')->dropDownList($model->tipologia_choices, ["prompt" => "Scegli"])->label(false) ?>
        </div>
        <div class="col-md-4">
            <label>Settore</label>
            <?= $form->field($model, 'id_settore')->dropDownList($model->settore_choices, ["prompt" => "Scegli"])->label(false) ?>
        </div>
    </div>

    <?php // echo $form->field($model, 'data_pubblicazione') 
    ?>

    <?php // echo $form->field($model, 'titolo') 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Cerca', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella Filtri', Url::to(["index"]), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>