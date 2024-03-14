<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="active control-label" for="user-nome">Nome</label>
            <input type="text" name="User[nome]" id="user-nome" value="<?= $model->nome ?>" class="form-control">
        </div>


        <div class="form-group col-md-4">
            <label class="active control-label" for="user-username">Username</label>
            <input type="text" name="User[username]" id="user-username" value="<?= $model->username ?>" class="form-control">
        </div>

        <div class="form-group col-md-4">
            <label class="active control-label" for="user-email">Email</label>
            <input type="email" name="User[email]" id="user-email" value="<?= $model->email ?>" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label class="active control-label" for="user-password">Password</label>
            <input type="password" name="User[password]" id="user-password" disabled="<?= $model->isNewRecord ? "disabled" : "" ?>" value="<?= $model->password ?>" class="form-control">
        </div>

        <div class="form-group col-md-4">
            <div class="select-wrapper">
                <label class="active control-label" for="user-status">Stato</label>
                <select id="user-status" name="User[status]">
                    <option selected="" value="">Scegli un'opzione</option>
                    <?php foreach ($model->statusList as $key => $value) { ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group col-md-4">
            <div class="select-wrapper">
                <label class="active control-label" for="defaultSelect">Ruolo</label>
                <select id="user-role" name="User[role]">
                    <option selected="" value="">Scegli un'opzione</option>
                    <?php foreach ($model->roleList as $key => $value) { ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <?php if (Yii::$app->controller->action->id == "update") { ?>
        <div class="row" style="margin-top: 10px">
            <div class="form-group col-md-6">
                <label class="active control-label" for="user-new_password">Nuova password</label>
                <input type="password" name="User[new_password]" id="user-new_password" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label class="active control-label" for="user-new_password_confirm">Conferma Nuova password</label>
                <input type="password" name="User[new_password_confirm]" id="user-new_password_confirm" class="form-control">
            </div>
        </div>
    <?php } ?>

    <div class="form-group" style="margin-top: 10px">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>