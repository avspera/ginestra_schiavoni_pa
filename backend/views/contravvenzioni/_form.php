<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contravvenzione-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card shadow-sm rounded">
        <div class="card-header px-4 border-0">
            <h3>Dati contravvenzione</h3>
        </div>
        <div class="card-body">
            <div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="active control-label" for="contravvenzione-amount">Importo</label>
                        <input type="text" name="Contravvenzione[amount]" id="contravvenzioni-importo" value="<?= $model->amount ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="active control-label" for="contravvenzione-articolo_codice">Articolo del codice infranto</label>
                        <input type="text" name="Contravvenzione[articolo_codice]" id="contravvenzioni-articolo_codice" value="<?= $model->amount ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <div class="field-contravvenzione-data_accertamento">
                            <label class="active control-label" for="dateStandard">Data accertamento</label>
                            <input value="<?= !empty($model->data_accertamento) ? date("Y-m-d", strtotime($model->data_accertamento)) : "" ?>" type="date" id="contravvenzione-data_accertamento" max="<?= date("Y-m-d") ?>" name="Contravvenzione[data_accertamento]">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="active control-label" class="active" for="timeStandard">Orario accertamento</label>
                        <input class="form-control" id="contravvenzione-orario_accertamento" name="Contravvenzione[orario_accertamento]" value="<?= date("H:i", strtotime($model->orario_accertamento)) ?>" type="time">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="active control-label" for="contravvenzione-luogo">Via</label>
                        <input type="text" name="Contravvenzione[luogo]" id="contravvenzioni-luogo" value="<?= $model->luogo ?>" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label class="active control-label" for="contravvenzione-targa">Targa</label>
                        <input type="text" name="Contravvenzione[targa]" id="contravvenzioni-targa" value="<?= $model->targa ?>" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="active control-label" for="punti_patente">Punti patente</label>
                        <input type="number" data-bs-input class="form-control" name="Contravvenzione[punti_patente]" id="contravvenzione-punti_patente" value="<?= $model->punti_patente ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <div class="select-wrapper">
                            <label class="active control-label" for="defaultSelect">Pagato</label>
                            <select id="contravvenzione-payed" name="Contravvenzione[payed]">
                                <option selected="" value="">Scegli un'opzione</option>
                                <option <?= $model->payed == 0 ? "selected" : "" ?> value="0">NO</option>
                                <option <?= $model->payed == 1 ? "selected" : "" ?> value="1">SI</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-4">
                    <div class="select-wrapper">
                        <label class="active control-label" for="defaultSelect">Strumento</label>
                        <select id="contravvenzione-strumento" name="Contravvenzione[strumento]">
                            <option selected="" value="">Scegli un'opzione</option>
                            <?php foreach ($model->strumento_choices as $key => $value) { ?>
                                <option <?= $model->strumento == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group field-contravvenzione-data_pagamento">
                        <label class="active control-label" for="dateStandard">Data pagamento</label>
                        <input value="<?= !empty($model->data_pagamento) ? date("Y-m-d", strtotime($model->data_pagamento)) : "" ?>" type="date" id="contravvenzione-data_pagamento" max="<?= date("Y-m-d") ?>" name="Contravvenzione[data_pagamento]">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="active control-label" for="contravvenzione-ricevuta_pagamento">Ricevuta di pagamento</label>
                        <input readonly type="text" name="Contravvenzione[ricevuta_pagamento]" id="contravvenzioni-ricevuta_pagamento" value="<?= $model->ricevuta_pagamento ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm rounded">
        <div class="card-header px-4 border-0">
            <h3>Dati pagatore</h3>
        </div>
        <div class="card-body my-2">
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="select-wrapper">
                                <label class="active control-label" for="defaultSelect">Tipo di persona</label>
                                <select id="contravvenzione-payed" name="Contravvenzione[tipo_persona]">
                                    <option selected="" value="">Scegli un'opzione</option>
                                    <?php foreach ($model->tipo_persona_choices as $key => $value) { ?>
                                        <option <?= $model->tipo_persona == $key ? "selected" : "" ?> value="<?= $key ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="nome">Nome</label>
                            <input type="text" name="Contravvenzione[nome]" id="contravvenzione-nome" value="<?= $model->nome ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="cognome">Cognome</label>
                            <input type="text" name="Contravvenzione[cognome]" id="contravvenzione-cognome" value="<?= $model->cognome ?>" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="email">Email</label>
                            <input type="email" name="Contravvenzione[email]" id="contravvenzione-email" value="<?= $model->email ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="cf">Codice Fiscale</label>
                            <input type="text" maxlength="16" name="Contravvenzione[cf]" id="contravvenzione-cf" value="<?= $model->cf ?>" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="via">Via</label>
                            <input type="text" name="Contravvenzione[via]" id="contravvenzione-via" value="<?= $model->via ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="civico">Civico</label>
                            <input type="text" name="Contravvenzione[civico]" id="contravvenzione-civico" value="<?= $model->civico ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="cap">Cap</label>
                            <input type="text" maxlength="5" name="Contravvenzione[cap]" id="contravvenzione-cap" value="<?= $model->cap ?>" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="comune">Comune</label>
                            <input type="text" name="Contravvenzione[comune]" id="contravvenzione-comune" value="<?= $model->comune ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="prov">Provincia</label>
                            <input type="text" name="Contravvenzione[prov]" maxlength="2" id="contravvenzione-prov" value="<?= $model->prov ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="active control-label" for="nazione">Nazione</label>
                            <input maxlength="2" type="text" name="Contravvenzione[nazione]" id="contravvenzione-nazione" value="<?= $model->nazione ?>" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-xs btn-success float-end']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>