<?php

use yii\widgets\ActiveForm;

$cittadino = Yii::$app->params["spidJsonUser"];
$model->id_cittadino = $cittadino["id"];
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'class' => "text-black",
        'action' => yii\helpers\Url::to(["cittadino/add-veicolo"])
    ]); ?>

    <div class="modal-content">
        <div class="cmp-modal__header modal-header pb-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
            </button>
            <h2 class="cmp-modal__header-title title-large-semi-bold" id="modal-vehicle-modal-title">Veicolo</h2>
            <p class="cmp-modal__header-info">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>
        </div>
        <div class="modal-body">
            <div class="mb-4">

                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="veicolo">Intestatario*</label>
                    <?= $form->field($model, "id_cittadino")->hiddenInput()->label(false); ?>
                    <input type="text" class="form-control" id="accountholder" name="accountholder" placeholder="<?= $cittadino["fullname"] ?>" required="" disabled="disabled">
                    <div class="d-flex">
                        <span class="form-text cmp-input__text">
                            Campo non modificabile</span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="select-wrapper">
                    <label for="veicolo-tipo_veicolo" class="">Tipo Veicolo*</label>
                    <select name="Veicolo[tipo_veicolo]" id="veicolo-tipo_veicolo" placeholder="Scegli" required>
                        <option selected="selected" value="">Scegli</option>
                        <?php foreach ($model->tipo_veicolo_choices as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="veicolo-marca">Marca*</label>
                    <input type="text" class="form-control" id="veicolo-marca" name="Veicolo[marca]" placeholder="Mini" required>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="veicolo-modello">Modello*</label>
                    <input type="text" class="form-control" id="veicolo-modello" name="Veicolo[modello]" placeholder="Countryman F60" required>
                </div>
            </div>

            <div class="mb-4">

                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="veicolo-targa">Targa*</label>
                    <input type="text" class="form-control" id="veicolo-targa" name="Veicolo[targa]" placeholder="CK 345 HB" required="">
                </div>

            </div>

            <div class="mb-4">
                <div class="select-wrapper">
                    <label for="veicolo-tipo_relazione" class="">Relazione*</label>
                    <select id="veicolo-tipo_relazione" name="Veicolo[tipo_relazione]" class="" required="">
                        <option selected="selected" value="">Scegli</option>
                        <?php foreach ($model->tipo_relazione_choices as $key => $value) { ?>
                            <option value="<?= $key ?>">
                                <?= $value ?>
                            </option>
                        <?php } ?>
                    </select>
                    <div class="d-flex">
                        <span class="form-text cmp-input__text">
                            Seleziona la tipologia di relazione</span>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="cmp-upload">
                    <span class="cmp-upload__label">Dichiarazione di concessione*</span>
                    <ul class="upload-file-list cmp-upload__list m-0">
                    </ul>
                    <input type="file" name="Veicolo[allegato_1][]" id="veicolo-allegato_1" class="upload" multiple="multiple">
                    <label for="veicolo-allegato_1" class="w-100 d-flex justify-content-center">
                        <svg class="icon icon-sm" aria-hidden="true">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-upload"></use>
                        </svg>
                        <span>Carica documento</span>
                    </label>
                    <p class="mt-2 cmp-upload__info mb-4">Caricare uno o più file in formato pdf, jpg, png</p>
                </div>
            </div>

            <div class="mb-4">
                <div class="cmp-upload">
                    <span class="cmp-upload__label">Dichiarazione di concessione*</span>
                    <ul class="upload-file-list cmp-upload__list m-0">
                    </ul>
                    <input type="file" name="Veicolo[allegato_2][]" id="veicolo-allegato_2" class="upload" multiple="multiple">
                    <label for="veicolo-allegato_2" class="w-100 d-flex justify-content-center">
                        <svg class="icon icon-sm" aria-hidden="true">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-upload"></use>
                        </svg>
                        <span>Carica documento</span>
                    </label>
                    <p class="mt-2 cmp-upload__info mb-4">Caricare uno o più file in formato pdf, jpg, png</p>
                </div>
            </div>
        </div>
        <div class="modal-footer shadow flex-nowrap pt-4 w-100">
            <button class="btn btn-outline-primary w-100 fw-bold me-4" type="button" data-bs-dismiss="modal">Annulla</button>
            <button class="btn btn-primary w-100 fw-bold" type="submit">Salva</button>
        </div>
    </div>

    <?php ActiveForm::end() ?>

</div>