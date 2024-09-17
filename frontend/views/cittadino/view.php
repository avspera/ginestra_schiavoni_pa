<?php

/** @var yii\web\View $this */
/** @var common\models\Cittadino $model */

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
        <li class="nav-item w-100" role="tab" aria-selected="false">
          <a class="nav-link justify-content-start text-tab active show" href="#data-scrivania" aria-controls="tab1" aria-selected="true" data-bs-toggle="tab" role="button" data-focus-mouse="false">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-pa"></use>
            </svg>
            Scrivania
          </a>
        </li>
        <li class="nav-item w-100" role="tab" aria-selected="false">
          <a class="nav-link justify-content-start text-tab" href="#data-messages" aria-controls="tab2" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-mail"></use>
            </svg>
            Messaggi
          </a>
        </li>
        <li class="nav-item w-100" role="tab" aria-selected="false">
          <a class="nav-link justify-content-start text-tab" href="#data-attivita" aria-controls="tab3" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
            <svg class="icon me-1 mr-lg-10" aria-hidden="true">
              <use href="/bootstrap-italia/svg/sprites.svg#it-files"></use>
            </svg>
            Attività
          </a>
        </li>
        <li class="nav-item w-100" role="tab" aria-selected="false">
          <a class="nav-link justify-content-start text-tab" href="#data-ex-tab4" aria-controls="tab4" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
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
    <div class="tab-pane fade active show" id="data-scrivania" role="tabpanel">
      <?= $this->render("snippets/_scrivania", ["model" => $model, "latest_messages" => $latest_messages, "latest_attivita" => $latest_attivita]) ?>
    </div>

    <div class="tab-pane" id="data-messages" role="tabpanel">
      <?= $this->render("snippets/_latest-messages", ["items" => $latest_messages, "latest_attivita" => $latest_attivita]) ?>
    </div>

    <div class="tab-pane" id="data-attivita" role="tabpanel">
      <?= $this->render("snippets/_attivita", ["items" => $latest_attivita]) ?>
    </div>

  </div>
</div>