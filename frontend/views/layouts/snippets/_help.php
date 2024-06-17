<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                <div class="cmp-contacts">
                    <div class="card w-100">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold">Contatta il comune</h2>
                            <ul class="contact-list p-0">
                                <li><a class="list-item" href="#">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-help-circle"></use>
                                        </svg><span>Leggi le domande frequenti</span></a></li>

                                <li><a class="list-item" href="#" data-element="contacts">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-mail"></use>
                                        </svg><span>Richiedi assistenza</span></a></li>

                                <li><a class="list-item" href="#">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-hearing"></use>
                                        </svg><span>Chiama il numero verde 05 0505</span></a></li>

                                <li><a class="list-item" href="#" data-element="appointment-booking">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-calendar"></use>
                                        </svg><span>Prenota appuntamento</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cmp-modal">
        <div class="modal fade" tabindex="-1" id="modal-save-1" aria-labelledby="modal-save-1-modal-title" data-focus-mouse="false" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered small" role="document">
                <div class="modal-content modal-dimensions">
                    <div class="cmp-modal__header modal-header pb-0">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
                        </button>
                        <h2 class="cmp-modal__header-title title-mini" id="modal-save-1-modal-title">Salva i dati in area personale</h2>
                        <p class="cmp-modal__header-info header-font">Vuoi salvare
                            le informazioni anche nella tua area personale? Potrai usarle anche in altre occasioni.</p>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer pb-70 pt-0">
                        <button class="btn btn-primary w-100 mx-0 fw-bold mb-4" type="submit" data-bs-toggle="modal" data-bs-target="#modal-save-2" form="">Salva nella mia
                            area personale</button>
                        <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal fw-bold" type="button">Salva solo per questa pratica</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cmp-modal">
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-save-2" aria-labelledby="modal-save-2-modal-title">
            <div class="modal-dialog modal-dialog-centered small" role="document">
                <div class="modal-content modal-dimensions">
                    <div class="cmp-modal__header modal-header pb-0">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale">
                        </button>
                        <h2 class="cmp-modal__header-title title-mini" id="modal-save-2-modal-title">Salva i dati in area personale</h2>
                        <p class="cmp-modal__header-info header-font">Vuoi salvare le informazioni anche nella tua area personale? Potrai riutilizzarle in futuro per altre pratiche.</p>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center align-items-center pb-70">
                            <svg class="icon icon-success icon-md">
                                <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-check-circle"></use>
                            </svg>
                            <span class="cmp-modal__success-message">Salvataggio effettuato</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>