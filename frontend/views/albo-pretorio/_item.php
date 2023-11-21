<?php

use yii\helpers\Url;
use common\components\Utils;
?>
<div class="row">
    <div class="col-lg-2">
        <div class="neutral-2-bg-b1 border neutral-2-border-color-b2 mb-2 mb-lg-0">
            <div class="card-body row text-start text-md-center p-1 p-lg-2 my-0 my-lg-2">
                <div class="col-auto col-lg-12 float-start float-lg-none">
                    <span class="h5 mb-0">
                        <div class="text-value">N. <b><?= $model->id ?></b></div>
                    </span>
                </div>
                <div class="col-auto col-lg-12 float-start float-lg-none">
                    <span class="h5 mb-0">
                        <div>pubblicata il</div>
                    </span>
                </div>
                <div class="col-auto col-lg-12 float-start float-lg-none">
                    <span class="h5 mb-0">
                        <div class="text-uppercase"><b><?= Utils::formatDate($model->data_pubblicazione) ?></b></div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-10">
        <span class="h5"><?= $model->titolo ?></span>
        <div class="collapse-header d-block d-sm-none mt-2" id="det20514">
            <a class="ps-0 border-top-0" data-bs-toggle="collapse" aria-expanded="false" href="<?= Url::to(["view", "id" => $model->id]) ?>" role="button">Dettagli pubblicazione</a>
        </div>
        <div id="collapse20514" class="collapse d-sm-block" role="tabpanel">
            <div class="collapse-body ps-0 py-2">
                <ul class="list-unstyled mb-0">
                    <li>
                        <span class="d-inline-block col-12 col-md-3 ps-0">Fine pubblicazione:</span>
                        <span><b><?= $model->data_fine_pubblicazione ?></b></span>
                    </li>
                    <li>
                        <span class="d-inline-block col-12 col-md-3 ps-0">Tipo documento:</span> <strong>
                            <?= $model->getTipologia() ?>
                        </strong>
                    </li>
                    <li><span class="d-inline-block col-12 col-md-3 ps-0">Settore:</span> <strong><?= $model->getSettore(); ?></strong></li>
                    <li><span class="d-inline-block col-12 col-md-3 ps-0">Atto:</span> N. <strong><?= $model->numero_atto ?></strong> del <strong><?= Utils::formatDate($model->data_pubblicazione) ?></strong></li>

                    <li class="mb-2">Scarica i documenti: </li>
                    <li>
                        <?php foreach ($model->attachments as $item) { ?>
                            <a target="_blank" class="pdf" title="Clicca per aprire il documento (formato PDF)" href="/Malalbergo/albo/dati/20230105G.PDF">20230105G.PDF<span class="fw-normal ms-2">( 233,69 Kb )</span></a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<hr>