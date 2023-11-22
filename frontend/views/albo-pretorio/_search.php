<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AlboPretorioSearch $model */
/** @var yii\widgets\ActiveForm $form */
$anni_list = Utils::getListaAnni();

?>

<div class="albo-pretorio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => "searchAlbo"
    ]); ?>

    <div class="card-wrapper card-space">
        <div class="card card-bg card-big no-after">
            <div class="card-body p-3 p-md-5 lightgrey-bg-c1">
                <div class="mb-4">
                    <div class="float-start col-md-6 mb-0 mb-md-5">
                        <span class="card-title h4">Cerca nell'Albo Pretorio</span>
                    </div>
                    <div class="float-end col-md-6 mb-5 mb-md-0 text-start text-md-end">
                        <span class="data">
                            <span class="dataagg">Ultimo aggiornamento: <?= $latestUpdate ?></span>
                        </span>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div>
                    <div class="row">
                        <div class="form-group d-inline-flex col-md-3 col-xs-12">
                            <div class="form-control select-wrapper p-0">
                                <label for="id_tipologia">Tipologia</label>
                                <select id="albopretoriosearch-id_tipologia" name="AlboPretorioSearch[id_tipologia]">
                                    <option value="">Tutti</option>
                                    <?php foreach ($model->tipologia_choices as $key => $value) { ?>
                                        <option <?= $model->id_tipologia == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-inline-flex col-md-3 col-xs-12">
                            <div class="form-control select-wrapper p-0">
                                <label for="anno">Anno</label>
                                <select id="albopretoriosearch-anno" name="AlboPretorioSearch[anno]">
                                    <option value="">Tutti</option>
                                    <?php foreach ($anni_list as $item) { ?>
                                        <option <?= $model->anno == $item ? "selected" : "" ?> value="<?= $item ?>"><?= $item ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group field-albopretoriosearch-oggetto">
                                <label class="control-label" for="albopretoriosearch-oggetto">Oggetto</label>
                                <input type="text" id="albopretoriosearch-oggetto" class="form-control" name="AlboPretorioSearch[oggetto]" data-focus-mouse="false">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group field-albopretoriosearch-numero_affissione">
                                <label class="control-label" for="albopretoriosearch-numero_affissione">Numero Affissione</label>
                                <input type="text" id="albopretoriosearch-numero_affissione" class="form-control" name="AlboPretorioSearch[numero_affissione]" data-focus-mouse="false">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group field-albopretoriosearch-numero_atto">
                                <label class="control-label" for="albopretoriosearch-numero_atto">Numero Atto</label>
                                <input type="text" id="albopretoriosearch-numero_atto" class="form-control" name="AlboPretorioSearch[numero_atto]" data-focus-mouse="false">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group field-albopretoriosearch-data_pubblicazione">
                                <label class="active" for="dateStandard">Data pubblicazione</label>
                                <input type="date" id="albopretoriosearch-data_pubblicazione" max="<?= date("Y-m-d") ?>" name="AlboPretorioSearch[data_pubblicazione]">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-start col-md-6 col-xs-12">
                    <div class="form-group">
                        <div class="py-1">
                            <?= Html::submitButton('Cerca', ['class' => 'btn btn-primary m-1']) ?>
                            <?= Html::a('Annulla', Url::to(["index"]), ['class' => 'btn btn-outline-secondary m-1']) ?>
                            <?= Html::button("Scarica in formato csv", ["class" => "btn btn-outline-success m-1", "onclick" => "javascript:exportData()"]) ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function exportData() {
        let data = $("form[id=searchAlbo]").find("input, select").serialize();
        window.location.href = '<?= Url::to(["export"]) ?>?' + data;
    }
</script>