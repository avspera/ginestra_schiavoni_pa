<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group field-usersearch-id">
                            <label class="control-label active" for="usersearch-id">ID</label>
                            <input type="text" value="<?= $model->id ?>" id="usersearch-id" class="form-control" name="UserSearch[id]" data-focus-mouse="false">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group field-usersearch-nome">
                            <label class="control-label active" for="usersearch-nome">Nome</label>
                            <input type="text" value="<?= $model->nome ?>" id="usersearch-nome" class="form-control" name="UserSearch[nome]" data-focus-mouse="false">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group field-usersearch-email">
                            <label class="control-label active" for="usersearch-email">Email</label>
                            <input type="text" value="<?= $model->email ?>" id="usersearch-email" class="form-control" name="UserSearch[email]" data-focus-mouse="false">
                        </div>
                    </div>
                </div>

                <div class="float-start col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="py-1">
                            <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary m-1']) ?>
                            <?= Html::a('Annulla', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary m-1']) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>