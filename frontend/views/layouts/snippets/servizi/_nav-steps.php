<div class="cmp-nav-steps">
    <nav class="steppers-nav" aria-label="Step">
        <button onclick="goBack('<?= $step ?>')" type="button" class="btn btn-sm steppers-btn-prev p-0">
            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-chevron-left"></use>
            </svg>
            <span class="text-button-sm t-primary">Indietro</span>
        </button>

        <button onclick="freezeAction('<?= $step ?>')" type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn">
            <span class="text-button-sm t-primary">Salva Richiesta</span>
        </button>

        <?php if ($step < 4) { ?>
            <button onclick="goAhead(<?= $step ?>)" type="button" class="btn btn-primary btn-sm steppers-btn-confirm" data-bs-toggle="modal" data-bs-target="#modal-save-1">
                <span class="text-button-sm">Avanti</span>
                <svg class="icon icon-white icon-sm" aria-hidden="true">
                    <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-chevron-right"></use>
                </svg>
            </button>
        <?php } ?>

        <?php if ($step == 4) { ?>
            <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm send" data-bs-toggle="modal" data-bs-target="#modal-terms" data-focus-mouse="false">
                <span class="text-button-sm">Invia</span>
            </button>
        <?php } ?>
    </nav>
    <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
        <span class="d-inline-block text-uppercase cmp-disclaimer__message">Richiesta salvata con successo</span>
    </div>
</div>