<?php

use yii\widgets\ActiveForm; ?>


<div class="cittadino-form">

    <?php $form2 = ActiveForm::begin([
        'id' => "cittadino-form",
        'action' => yii\helpers\Url::to(["cittadino/upload-attachment", "id" => $cittadino->id]),
        'options' => [
            'enctype' => 'multipart/form-data'
        ],
    ])
    ?>

    <div class="modal-content">
        <!-- Header -->
        <div class="cmp-modal__header modal-header pb-0">
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
            </button>
            <h2 class="cmp-modal__header-title title-large-semi-bold" id="modal-vehicle-modal-title">Documenti</h2>
            <p class="cmp-modal__header-info">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>
        </div>

        <!-- Body -->
        <div class="modal-body">
            <input type="hidden" name="Cittadino[id]" value="<?= $cittadino->id ?>" id="cittadino-id" />
            <div class="cmp-upload">
                <span class="cmp-upload__label">Patente di guida</span>
                <ul class="upload-file-list cmp-upload__list m-0">
                    <?php if (!empty($cittadino->patente_di_guida)) {
                        $patente = explode(",", $cittadino->patente_di_guida);  // Corretto "patante_di_guida"
                        foreach ($patente as $pt) {
                    ?>
                            <li class="upload-file success">
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use href="/bootstrap-italia/svg/sprites.svg#it-file"></use>
                                </svg>
                                <p class="cmp-upload__list-item">
                                    <span class="visually-hidden">File caricato:</span>
                                    <?= substr($pt, strrpos($pt, "/") + 1) ?> <!-- Aggiunto +1 per rimuovere anche lo slash -->
                                </p>
                                <button type="button">
                                    <span class="visually-hidden">Elimina il documento</span>
                                    <svg class="icon icon-sm" aria-hidden="true">
                                        <use href="/bootstrap-italia/svg/sprites.svg#it-close"></use>
                                    </svg>
                                </button>
                            </li>
                    <?php }
                    } ?>
                </ul>

                <input type="file" name="Cittadino[patente_di_guida][]" id="cittadino-patente_di_guida" class="upload" multiple="multiple">
                <label for="cittadino-patente_di_guida" class="w-100 d-flex justify-content-center">
                    <svg class="icon icon-sm" aria-hidden="true">
                        <use href="/bootstrap-italia/svg/sprites.svg#it-upload"></use>
                    </svg>
                    <span>Carica documento</span>
                </label>

                <p class="mt-2 cmp-upload__info mb-4">Caricare uno o più file in formato pdf, jpg, png con fronte e retro del documento</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer shadow flex-nowrap pt-4 w-100">
            <button class="btn btn-outline-primary w-100 fw-bold me-4" type="button" data-bs-dismiss="modal">Annulla</button>
            <button class="btn btn-primary w-100 fw-bold" type="submit" id="upload-attachment-button">Salva</button>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    
    // $('#cittadino-form').on('submit', function(event) {
    //     event.stopPropagation(); // Impedisce la propagazione dell'evento
    // });
</script>