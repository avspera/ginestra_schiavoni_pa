<?php

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

use yii\helpers\Url;

use common\components\Utils;

$this->title = "Area privata di " . $model->fullname;

// $this->params['breadcrumbs'][] = ['label' => 'Contravvenziones', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
  'label' => $this->title,
  'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

?>
<div class="row justify-content-center">
  <div class="col-12 col-lg-10">
    <div class="cmp-heading pb-3 pb-lg-4">
      <h1 class="title-xxxlarge"><?= $model->fullname ?></h1>
      <p class="subtitle-small">CF: <?= $model->codice_fiscale ?></p>
    </div>
  </div>
</div>
<div class="row justify-content-center">
  <div class="col-12 p-0">
    <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
      <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap" id="myTab" role="tablist">
        <li class="nav-item w-100" role="tab" aria-selected="false" tabindex="-1">
          <a class="nav-link justify-content-start text-tab active show" href="#data-ex-tab1" aria-current="page" aria-controls="tab1" aria-selected="true" data-bs-toggle="tab" role="button" data-focus-mouse="false" tabindex="-1">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-pa"></use>
            </svg>
            Scrivania
          </a>
        </li>
        <li class="nav-item w-100" role="tab" aria-selected="false" tabindex="-1">
          <a class="nav-link justify-content-start text-tab" href="#data-ex-tab2" aria-current="page" aria-controls="tab2" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false" tabindex="-1">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-mail"></use>
            </svg>
            Messaggi
          </a>
        </li>
        <li class="nav-item w-100" role="tab" aria-selected="false" tabindex="-1">
          <a class="nav-link justify-content-start text-tab" href="#data-ex-tab3" aria-current="page" aria-controls="tab3" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false" tabindex="-1">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-files"></use>
            </svg>
            Attività
          </a>
        </li>
        <li class="nav-item w-100" role="tab" aria-selected="false" tabindex="-1">
          <a class="nav-link justify-content-start text-tab" href="#data-ex-tab4" aria-current="page" aria-controls="tab4" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false" tabindex="-1">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-settings"></use>
            </svg>
            Servizi
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="it-page-sections-container">
  <!-- Tab panels -->
  <div class="tab-content">
    <div class="tab-pane fade active show" id="data-ex-tab1" role="tabpanel">
      <div class="row">
        <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
          <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DI PAGINA" data-bs-navscroll="">
              <div class="navbar-custom" id="navbarNavProgress">
                <div class="menu-wrapper">
                  <div class="link-list-wrapper">
                    <div class="accordion">
                      <div class="accordion-item">
                        <span class="accordion-header" id="accordion-title-one">
                          <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                            INDICE DI PAGINA
                            <svg class="icon icon-xs right">
                              <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                            </svg>
                          </button>
                        </span>
                        <div class="progress">
                          <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="91.79878048780488" aria-valuemin="0" aria-valuemax="100" style="width: 91.79878%;"></div>
                        </div>
                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                          <div class="accordion-body">
                            <ul class="link-list" data-element="page-index">
                              <li class="nav-item">
                                <a class="nav-link" href="#latest-posts">
                                  <span>Ultimi messaggi</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#latest-activities">
                                  <span>Ultime attività</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>

        <div class="col-12 col-lg-8 offset-lg-1">
          <div class="it-page-section mb-40 mb-lg-60" id="latest-posts">
            <div class="cmp-card">
              <div class="card">
                <div class="card-header border-0 p-0 mb-lg-20">
                  <div class="d-flex">
                    <h2 class="title-xxlarge">Ultimi messaggi</h2>
                  </div>
                </div>
                <div class="card-body p-0">

                  <div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="#modal-message" id="1">
                    <div class="card shadow-sm px-4 pt-4 pb-4">
                      <span class="visually-hidden">Categoria:</span>
                      <div class="card-header border-0 p-0 m-0">
                        <date class="date-xsmall">02/03/2022</date>
                      </div>
                      <div class="card-body p-0 my-2">
                        <h3 class="title-small-semi-bold t-primary m-0 mb-1"><a href="#" class="text-decoration-none">Richiesta pass ZTL</a></h3>
                        <p class="text-paragraph text-truncate">La richiesta AN4059281 è stata accetto</p>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                    <span class="">Vedi altri messaggi</span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="it-page-section mb-50 mb-lg-90" id="latest-activities">
            <div class="cmp-card">
              <div class="card">
                <div class="card-header border-0 p-0 mb-lg-20">
                  <div class="d-flex">
                    <h2 class="title-xxlarge mb-3">Ultime attività</h2>
                  </div>
                </div>
                <div class="card-body p-0">

                  <?php foreach ($latest_attivita as $item) {
                  ?>
                    <div class="cmp-icon-card mb-3">
                      <div class="card pt-20 pb-4 ps-4 pr-30 drop-shadow">
                        <div class="cmp-card-title d-flex">
                          <svg class="icon icon-sm me-2" aria-hidden="true">
                            <use href="/bootstrap-italia/svg/sprites.svg#it-files"></use>
                          </svg>
                          <h3 class="t-primary mb-2 title-small-semi-bold">
                            <a href="<?= Url::to([$item["url"], "id" => $item["id"]]) ?>"><?= $item["label"] ?></a>
                          </h3>
                        </div>
                        <div class="cmp-icon-card__description">
                          <date class="date-xsmall ml-30"><?= Utils::formatDate($item["date"]) ?></date>
                        </div>
                      </div>
                    </div>
                  <?php
                  } ?>

                  <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                    <span class="">Vedi altre attività</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane" id="data-ex-tab2" role="tabpanel"></div>

    <div class="tab-pane" id="data-ex-tab3" role="tabpanel">
      <div class="row">
        <div class="d-none d-sm-none d-lg-block col-lg-3">
          <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-Three">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DI PAGINA" data-bs-navscroll="">
              <div class="navbar-custom" id="navbarNavProgress">
                <div class="menu-wrapper">
                  <div class="link-list-wrapper">
                    <div class="accordion">
                      <div class="accordion-item">
                        <span class="accordion-header" id="accordion-title-Three">
                          <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Three" aria-expanded="true" aria-controls="collapse-Three">
                            INDICE DI PAGINA
                            <svg class="icon icon-xs right">
                              <use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                            </svg>
                          </button>
                        </span>
                        <div class="progress">
                          <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="91.79878048780488" aria-valuemin="0" aria-valuemax="100" style="width: 91.79878%;"></div>
                        </div>
                        <div id="collapse-Three" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-Three">
                          <div class="accordion-body">
                            <ul class="link-list" data-element="page-index">
                              <li class="nav-item">
                                <a class="nav-link" href="#practices">
                                  <span>Pratiche</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#payments">
                                  <span>Pagamenti</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>

        <?= $this->render("snippets/_attivita", ["items" => $latest_attivita]) ?>

      </div>
    </div>

    <div class="tab-pane" id="data-ex-tab4" role="tabpanel"></div>
  </div>
</div>