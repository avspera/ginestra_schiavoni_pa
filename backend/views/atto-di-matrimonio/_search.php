<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\Utils;

$anni_list = Utils::getListaAnni();
$params = isset(Yii::$app->request->queryParams["AlboPretorioSearch"]) ? Yii::$app->request->queryParams["AlboPretorioSearch"] : [];

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="atto-di-matrimonio-search">

    <div class="card-wrapper card-space">
        <div class="card card-bg  no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                ]); ?>

                <div class="mb-4">
                    <div class="float-start col-md-6 mb-md-5">
                        <span class="card-title h4">Cerca</span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($model, 'id') ?>
                    </div>
                    <div class="form-group col-md-3 col-xs-12">
                        <div class="form-control select-wrapper p-0">
                            <label class="control-label active" for="anno">Anno</label>
                            <select id="albopretoriosearch-anno" name="AlboPretorioSearch[anno]">
                                <option value="">Tutti</option>
                                <?php foreach ($anni_list as $item) {
                                    $selected = "";
                                    if (isset($params["anno"]) && $params["anno"] == $item) {
                                        $selected = "selected";
                                    }
                                ?>
                                    <option <?= $selected ?> value="<?= $item ?>"><?= $item ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?= Html::submitButton('Cerca', ['class' => 'btn btn-xs btn-primary']) ?>
                            <?= Html::a('Cancella Filtri', Url::to(["index"]), ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    </div>
</div>