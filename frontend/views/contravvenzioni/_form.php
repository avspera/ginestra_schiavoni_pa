<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var ActiveForm $form */
?>
<div class="contravvenzioni-_form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="form-group col-md-3">
            <label class="active control-label" for="contravvenzione-amount">Codice Fiscale</label>
            <input type="text" required maxlength="16" name="Contravvenzione[cf]" id="contravvenzioni-cf" value="<?= $model->cf ?>" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label class="active control-label" for="contravvenzione-articolo_codice">Identificativo univoco</label>
            <input type="text" required name="Contravvenzione[id_univoco_versamento]" id="contravvenzioni-id_univoco_versamento" value="<?= $model->id_univoco_versamento ?>" class="form-control">
        </div>
        <div class="form-group col-md-3"><?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?></div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div><!-- contravvenzioni-_form -->