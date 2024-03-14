<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Assistenza $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="assistenza-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <div class="card-header border-0 p-0">
        </div>
        <div class="card-body p-0 my-2">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="active control-label" for="assistenza-nome_richiedente">Nome</label>
                    <input type="text" name="Assistenza[nome_richiedente]" id="assistenza-nome_richiedente" value="<?= !empty($loggedUser["name"]) ? $loggedUser["name"] : $model->nome_richiedente ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label class="active control-label" for="assistenza-cf_richiedente">Codice fiscale</label>
                    <input type="text" name="Assistenza[cf_richiedente]" id="assistenza-cf_richiedente" value="<?= !empty($loggedUser["fiscal_code"]) ? $loggedUser["fiscal_code"] : $model->cf_richiedente ?>" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label class="active control-label" for="assistenza-email_richiedente">Email</label>
                    <input type="text" name="Assistenza[email_richiedente]" id="assistenza-email_richiedente" value="<?= !empty($loggedUser["email"]) ? $loggedUser["email"] : $model->email_richiedente ?>" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="select-wrapper">
                        <label class="active control-label" for="assistenza-motivo_richiesta">Motivo richiesta</label>
                        <select id="assistenza-motivo_richiesta" name="Assistenza[motivo_richiesta]">
                            <option selected="" value="">Scegli un'opzione</option>
                            <?php foreach ($model->motivo_richiesta_choices as $key => $value) { ?>
                                <option <?= $model->motivo_richiesta == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <div class="form-group">
                        <label for="assistenza-note">Messaggio</label>
                        <textarea class="form-control" id="assistenza-note" name="Assistenza[note]" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>