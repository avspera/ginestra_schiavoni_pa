<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\components\Utils;
?>
<div class="row mt-2">
    <div class="col-lg-2">
        <div class="neutral-2-bg-b1 border neutral-2-border-color-b2 mb-2 mb-lg-0">
            <div class="card-body row text-start text-md-center p-1 p-lg-2 my-0 my-lg-2">
                <div class="col-auto col-lg-12 float-start float-lg-none">
                    <span class="mb-0">
                        <div class="text-value">N. <b><?= $model->id ?></b></div>
                    </span>
                </div>
                <div class="col-auto col-lg-12 float-start float-lg-none">
                    <span class="mb-0">
                        <div>pubblicato il</div>
                    </span>
                </div>
                <div class="col-auto col-lg-12 float-start float-lg-none">
                    <span class="mb-0">
                        <div class="text-uppercase"><b><?= Utils::formatDate($model->data_pubblicazione) ?></b></div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <span class="h5"><a href="<?= Url::to(["view", "id" => $model->id]) ?>"><?= $model->oggetto ?></a></span>
        <div class="collapse-header d-block d-sm-none mt-2" id="<?= $model->id ?>">
            <a class="ps-0 border-top-0" data-bs-toggle="collapse" aria-expanded="false" href="#collapse<?= $model->id ?>" role="button">Dettagli pubblicazione</a>
        </div>
        <div id="collapse<?= $model->id ?>" class="collapse d-sm-block" role="tabpanel">
            <div class="collapse-body ps-0 py-2">
                <ul class="list-unstyled mb-0">
                    <li>
                        <span class="d-inline-block col-12 col-md-3 ps-0">Data pubblicazione:</span>
                        <span><b><?= Utils::formatDate($model->data_pubblicazione) ?></b></span>
                    </li>
                    <li>
                        <span class="d-inline-block col-12 col-md-3 ps-0">Data Fine pubblicazione:</span>
                        <span><b><?= Utils::formatDate($model->data_fine_pubblicazione) ?></b></span>
                    </li>
                    <li><span class="d-inline-block col-12 col-md-3 ps-0">Atto:</span> N. <strong><?= $model->numero_atto ?></strong> del <strong><?= Utils::formatDate($model->data_pubblicazione) ?></strong></li>
                    <?php if (!empty($model->numero_affissione)) { ?>
                        <li>
                            <span class="d-inline-block col-12 col-md-3 ps-0">Numero affissione:</span> <strong><?= $model->numero_affissione ?></strong>
                        </li>
                    <?php } ?>
                    <li>
                        <span class="d-inline-block col-12 col-md-3 ps-0">Tipo documento:</span> <strong>
                            <?php
                            $tipologia = $model->getTipologia($model->id_tipologia);
                            echo isset($tipologia["descrizioneDocumento"]) ? $tipologia["descrizioneDocumento"] : $model->id_tipologia;
                            ?>
                        </strong>
                    </li>

                    <!-- <li>
                        <span class="d-inline-block col-12 col-md-3 ps-0">Note:</span> <strong><?= !empty($model->note) ? $model->note : "-" ?></strong>
                    </li> -->

                    <?php if (!empty($model->id_atto_matrimonio)) { ?>
                        <li>
                            <span class="d-inline-block col-12 col-md-3 ps-0">Atto di matrimonio: </span> <strong><?= Html::a("Vedi dettagli", Url::to(["atto-di-matrimonio/view", "id" => $model->id_atto_matrimonio]), ["class" => "link"]) ?></strong>
                        </li>
                    <?php } ?>
                    <!-- <li class="mb-2">Scarica i documenti: </li>
                    <li>
                        <?php
                        if (!empty($model->attachments)) {
                            $attachments = json_decode($model->attachments, true);
                            foreach ($attachments as $item) {
                                $icon = substr($item->nomeFile, strrpos($item->nomeFile, ".")) == ".pdf" ? "it-file-pdf" : "it-file";
                        ?>
                                <svg class="icon" aria-hidden="true">
                                    <use href="/bootstrap-italia/svg/sprites.svg#<?= $icon ?>"></use>
                                </svg>
                                <a target="_blank" class="pdf" title="Clicca per aprire il documento (formato PDF)" href="<?= Url::to($allegato->url) ?>"><?= $allegato->nomeFile ?></a> <br />
                            <?php }
                        } else { ?>
                            <small class="text-sm">Nessun allegato disponibile</small>
                        <?php } ?>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</div>


<hr>