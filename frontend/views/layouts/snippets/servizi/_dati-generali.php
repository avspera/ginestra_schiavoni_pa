<?php
$cittadino = Yii::$app->params["spidJsonUser"];
?>
<div class="cmp-card mb-0">
    <div class="card has-bkg-grey shadow-sm p-big">
        <div class="card-header border-0 p-0 mb-lg-30">
            <div class="d-flex">
                <h2 class="title-xxlarge mb-1">Effettuato da</h2>
            </div>
            <p class="subtitle-small mb-0">Informazioni sulla persona che effettua il pagamento, che può essere diversa da chi richiede il servizio</p>
        </div>
        <div class="card-body p-0">
            <div class="cmp-info-button-card">
                <div class="card p-3 p-lg-4">
                    <div class="card-body p-0">
                        <h3 class="big-title mb-0"><?= $cittadino["fullname"] ?></h3>
                        <p class="card-info">Codice Fiscale <br> <span><?= $cittadino["codice_fiscale"] ?></span></p>

                        <div class="accordion-item">
                            <div class="accordion-header" id="heading-collapse-benef-1">
                                <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-benef-1" aria-expanded="false" aria-controls="collapse-benef-1">
                                    <span class="d-flex align-items-center">
                                        Mostra tutto
                                        <svg class="icon icon-primary icon-sm">
                                            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                            <div id="collapse-benef-1" class="accordion-collapse collapse" role="region">
                                <div class="accordion-body p-0">
                                    <div class="cmp-info-summary bg-white has-border">
                                        <div class="card">

                                            <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                <h4 class="title-large-semi-bold mb-3">Anagrafica</h4>
                                                <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                            </div>

                                            <div class="card-body p-0">
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">Nome</div>
                                                    <div class="border-light">
                                                        <p class="data-text">
                                                            <?= $cittadino["name"] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">Cognome</div>
                                                    <div class="border-light">
                                                        <p class="data-text">
                                                            <?= $cittadino["surname"] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">Codice fiscale</div>
                                                    <div class="border-light border-0">
                                                        <p class="data-text">
                                                            <?= $cittadino["codice_fiscale"] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-0 d-none">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cmp-info-summary bg-white has-border">
                                        <div class="card">

                                            <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                <h4 class="title-large-semi-bold mb-3">Indirizzo</h4>
                                                <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                            </div>

                                            <div class="card-body p-0">
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">Residenza</div>
                                                    <div class="border-light border-0">
                                                        <p class="data-text">
                                                            <?= $cittadino["indirizzo"] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-0 d-none">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>