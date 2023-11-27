<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ValutazioneServizio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="valutazione-servizio-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <h1>Quanto è stato facile usare questo servizio?</h1>
    </div>
    <div class="row" style="margin-top:20px;">
        <div class="col-md-6">
            <fieldset class="rating">
                <legend>Voto</legend>
                <input onclick="showMoreQuestion()" type="radio" id="star5a" name="overall_rating" value="5" />
                <label class="active control-label full" for="star5a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 5 stelle su 5</span>
                </label>
                <input type="radio" onclick="showMoreQuestion()" id="star4a" name="overall_rating" value="4" />
                <label class="full" for="star4a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 4 stelle su 5</span>
                </label>
                <input type="radio" onclick="showMoreQuestion()" id="star3a" name="overall_rating" value="3" />
                <label class="full" for="star3a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 3 stelle su 5</span>
                </label>
                <input type="radio" onclick="showMoreQuestion()" id="star2a" name="overall_rating" value="2" />
                <label class="full" for="star2a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 2 stelle su 5</span>
                </label>
                <input type="radio" onclick="showMoreQuestion()" id="star1a" name="overall_rating" value="1" />
                <label class="full" for="star1a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 1 stelle su 5</span>
                </label>
            </fieldset>
        </div>
        <div class="col-md-4 col-12" id="satisfaction_reason_wrapper" style="display:none;">
            <div class="select-wrapper">
                <?= $form->field($model, 'satisfaction_reason')->dropdownlist($model->satisfaction_reason_choices, ["prompt" => "Scegli"])->label("Motivo soddisfazione", ["class" => "active control-label"]) ?>
            </div>
        </div>
        <div class="form-group col-md-4 col-12" id="angry_reason_wrapper" style="display:none;">
            <div class="select-wrapper">
                <?= $form->field($model, 'angry_reason')->dropdownlist($model->angry_reason_choices, ["prompt" => "Scegli"])->label("Motivo insoddisfazione", ["class" => "active control-label"]) ?>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="form-group">
                <label class="active control-label" for="exampleFormControlTextarea1">Note</label>
                <textarea id="valutaservizio-note" name="ValutaServizio[note]" rows="3"></textarea>
            </div>
        </div>
    </div>

    <div class="form-group" style="margin-top:10px;">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function showMoreQuestion() {
        let rating = $("input[name=overall_rating]:checked").val();

        if (rating < 4) {
            $("#angry_reason_wrapper").css("display", "block");
            $("#satisfaction_reason_wrapper").css("display", "none");
        } else {
            $("#satisfaction_reason_wrapper").css("display", "block");
            $("#angry_reason_wrapper").css("display", "none");
        }
    }
</script>