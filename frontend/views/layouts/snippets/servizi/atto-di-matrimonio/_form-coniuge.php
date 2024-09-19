<?php

use yii\widgets\ActiveForm;

$model->id_cittadino = $cittadino->id;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'class' => "text-black",
        'action' => yii\helpers\Url::to(["cittadino/add-coniuge"])
    ]); ?>

    <div class="modal-content">
        <div class="cmp-modal__header modal-header pb-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
            </button>
            <h2 class="cmp-modal__header-title title-large-semi-bold" id="modal-vehicle-modal-title">Coniuge</h2>
            <p class="cmp-modal__header-info">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>
        </div>
        <div class="modal-body">
            <?= $form->field($model, "id_cittadino")->hiddenInput()->label(false); ?>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-nome">Nome*</label>
                    <input type="text" class="form-control" id="coniuge-nome" name="Coniuge[nome]" placeholder="" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-cognome">Cognome*</label>
                    <input type="text" class="form-control" id="coniuge-cognome" name="Coniuge[cognome]" placeholder="" required>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-email">Email</label>
                    <input type="text" class="form-control" id="coniuge-email" name="Coniuge[email]" placeholder="">
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-telefono">Telefono</label>
                    <input type="text" class="form-control" id="coniuge-telefono" name="Coniuge[telefono]" placeholder="">
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-codice_fiscale">Codice Fiscale*</label>
                    <input type="text" class="form-control" id="coniuge-codice_fiscale" name="Coniuge[codice_fiscale]" placeholder="" required>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-indirizzo_residenza">Indirizzo di residenza*</label>
                    <input type="text" class="form-control" id="coniuge-indirizzo_residenza" name="Coniuge[indirizzo_residenza]" placeholder="" required>
                </div>
            </div>
            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-indizzo_domicilio">Indirizzo di Domicilio</label>
                    <input type="text" class="form-control" id="coniuge-indizzo_domicilio" name="Coniuge[indirizzo_domicilio]" placeholder="">
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-data_di_nascita">Data di nascita*</label>
                    <input type="date" class="form-control" id="coniuge-data_di_nascita" name="Coniuge[data_di_nascita]" placeholder="" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-luogo_di_nascita">Luogo di nascita*</label>
                    <input type="text" class="form-control" id="coniuge-luogo_di_nascita" name="Coniuge[luogo_di_nascita]" placeholder="" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-group cmp-input">
                    <label class="cmp-input__label active" for="coniuge-cittadinanza">Cittadinanza*</label>
                    <input maxlength="3" type="text" class="form-control" id="coniuge-cittadinanza" name="Coniuge[cittadinanza]" placeholder="" required>
                </div>
            </div>

            <div class="mb-4">
                <div class="select-wrapper">
                    <label for="coniuge-stato_civile" class="">Stato civile*</label>
                    <select name="Coniuge[stato_civile]" id="coniuge-stato_civile" placeholder="Scegli" required>
                        <option selected="selected" value="">Scegli</option>
                        <?php foreach ($cittadino->stato_civile_choices as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <div class="mb-4">
                <div class="select-wrapper">
                    <label for="coniuge-titolo_di_studio" class="">Titolo di studio* </label>
                    <select name="Coniuge[titolo_studio]" id="coniuge-titolo_studio" placeholder="Scegli" required>
                        <option selected="selected" value="">Scegli</option>
                        <?php foreach ($cittadino->titolo_studio_choices as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>

            <div class="mb-4">
                <div class="select-wrapper">
                    <label for="coniuge-posizione_professionale" class="">Posizione professionale*</label>
                    <select onchange="checkCondizione()" name="Coniuge[posizione_professionale]" id="coniuge-posizione_professionale" placeholder="Scegli" required>
                        <option selected="selected" value="">Scegli</option>
                        <?php foreach ($cittadino->posizione_professionale_choices as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-4 d-none" id="condizione_non_professionale">
                <div class="select-wrapper">
                    <label for="coniuge-condizione_non_professionale" class="">Condizione non professionale*</label>
                    <select name="Coniuge[condizione_non_professionale]" id="coniuge-condizione_non_professionale" placeholder="Scegli">
                        <option selected="selected" value="">Scegli</option>
                        <?php foreach ($cittadino->condizione_non_professionale_choices as $key => $value) { ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <div class="cmp-upload">
                    <span class="cmp-upload__label">Carta di identità*</span>
                    <ul class="upload-file-list cmp-upload__list m-0">
                    </ul>
                    <input type="file" name="Coniuge[carta_identita][]" id="coniuge-carta_identita" class="upload" multiple="multiple">
                    <label for="coniuge-carta_identita" class="w-100 d-flex justify-content-center">
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

<script>
    function checkCondizione() {
        let choice = $("#coniuge-posizione_professionale option:selected").val();

        if (choice == 0) {
            $("#condizione_non_professionale").removeClass("d-none");
        } else {
            $("#condizione_non_professionale").addClass("d-none");
        }
    }
</script>