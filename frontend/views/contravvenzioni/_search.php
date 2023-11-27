<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ContravvenzioneSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <div class="mb-4">
                    <div class="float-start col-md-6 mb-0 mb-md-5">
                        <span class="card-title h4">Cerca</span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="active control-label" for="contravvenzione-id">NUMERO</label>
                            <input type="text" value="<?= $model->id ?>" class="form-control" name="ContravvenzioneSearch[id]" id="contravvenzione-id">
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?>
                        <?= Html::a('Annulla', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>