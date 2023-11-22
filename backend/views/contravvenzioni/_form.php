<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
        <div class="card-header border-0 p-0">
        </div>
        <div class="card-body p-0 my-2">
            <div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="contravvenzione-amount">Importo</label>
                        <input type="text" name="Contravvenzione[amount]" id="contravvenzioni-importo" value="<?= $model->amount ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="contravvenzione-articolo_codice">Articolo del codice infranto</label>
                        <input type="text" name="Contravvenzione[articolo_codice]" id="contravvenzioni-articolo_codice" value="<?= $model->amount ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <div class="field-contravvenzione-data_accertamento">
                            <label class="active" for="dateStandard">Data accertamento</label>
                            <input value="<?= !empty($model->data_pagamento) ? date("Y-m-d", strtotime($model->data_accertamento)) : "" ?>" type="date" id="contravvenzione-data_accertamento" max="<?= date("Y-m-d") ?>" name="Contravvenzione[data_accertamento]">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="active" for="timeStandard">Orario accertamento</label>
                        <input class="form-control" id="contravvenzione-orario_accertamento" name="Contravvenzione[orario_accertamento]" type="time">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="contravvenzione-luogo">Luogo</label>
                        <input type="text" name="Contravvenzione[luogo]" id="contravvenzioni-luogo" value="<?= $model->luogo ?>" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="contravvenzione-targa">Targa</label>
                        <input type="text" name="Contravvenzione[targa]" id="contravvenzioni-targa" value="<?= $model->targa ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="punti_patente">Punti patente</label>
                        <input type="number" data-bs-input class="form-control" id="contravvenzione-punti_patente" value="<?= $model->punti_patente ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <div class="select-wrapper">
                            <label for="defaultSelect">Pagata</label>
                            <select id="contravvenzione-payed" name="Contravvenzione[payed]">
                                <option selected="" value="">Scegli un'opzione</option>
                                <option value=0>NO</option>
                                <option value=1>SI</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-4">
                    <div class="select-wrapper">
                        <label for="defaultSelect">Strumento</label>
                        <select id="contravvenzione-strumento" name="Contravvenzione[strumento]">
                            <option selected="" value="">Scegli un'opzione</option>
                            <?php foreach ($model->strumento_choices as $key => $value) { ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group field-contravvenzione-data_pagamento">
                        <label class="active" for="dateStandard">Data pagamento</label>
                        <input value="<?= !empty($model->data_pagamento) ? date("Y-m-d", strtotime($model->data_pagamento)) : "" ?>" type="date" id="contravvenzione-data_pagamento" max="<?= date("Y-m-d") ?>" name="Contravvenzione[data_pagamento]">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="contravvenzione-ricevuta_pagamento">Ricevuta di pagamento</label>
                        <input type="text" name="Contravvenzione[ricevuta_pagamento]" id="contravvenzioni-ricevuta_pagamento" value="<?= $model->ricevuta_pagamento ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

</div>