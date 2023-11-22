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
    <div class="row">
        <div class="col-md-12">
            <fieldset class="rating">
                <legend>Voto</legend>
                <input onclick="showMoreQuestion()" type="radio" id="star5a" name="overall_rating" value="5" />
                <label class="full" for="star5a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 5 stelle su 5</span>
                </label>
                <input type="radio" id="star4a" name="overall_rating" value="4" />
                <label class="full" for="star4a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 4 stelle su 5</span>
                </label>
                <input type="radio" id="star3a" name="overall_rating" value="3" />
                <label class="full" for="star3a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 3 stelle su 5</span>
                </label>
                <input type="radio" id="star2a" name="overall_rating" value="2" />
                <label class="full" for="star2a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 2 stelle su 5</span>
                </label>
                <input type="radio" id="star1a" name="overall_rating" value="1" />
                <label class="full" for="star1a">
                    <svg class="icon icon-sm">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-star-full"></use>
                    </svg>
                    <span class="visually-hidden">Valuta 1 stelle su 5</span>
                </label>
            </fieldset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6" style="display:none;">
            <?= $form->field($model, 'satisfaction_reason')->dropdownlist($model->satisfaction_reason_choices, ["prompt" => "Scegli"]) ?>
        </div>
        <div class="form-group col-md-6" style="display:none;">
            <?= $form->field($model, 'angry_reason')->dropdownlist($model->angry_reason_choices, ["prompt" => "Scegli"]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group" style="margin-top:10px;">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function showMoreQuestion(){
        let rating = $("input[name=overall_rating]:checked").val();
        if(rating < 4){
            $("#valutazioneservizio-angry_reason").css("display", "block");
            $("#valutazioneservizio-satisfaction_reason").css("display", "none");
        } else {
            $("#valutazioneservizio-satisfaction_reason").css("display", "block");
            $("#valutazioneservizio-angry_reason").css("display", "none");
        }
    }
</script>