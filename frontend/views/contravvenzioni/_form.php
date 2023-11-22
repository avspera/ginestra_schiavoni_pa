<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <label for="amount" class="input-number-label">Importo</label>
            <span class="input-number input-number-currency">
                <input disabled type="number" data-bs-input id="contravvenzioni-amount" name="Contravvenzione[amount]" step="any" value="0" min="0" />
                <button class="input-number-add">
                    <span class="visually-hidden">Aumenta valore Euro</span>
                </button>
                <button class="input-number-sub">
                    <span class="visually-hidden">Diminuisci valore Euro</span>
                </button>
            </span>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-xs btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
