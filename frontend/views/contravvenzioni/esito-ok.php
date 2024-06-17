<?php
$this->title = "Pagamento multa";

$this->params['breadcrumbs'][] = [
    'label' => 'Servizi',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => 'Tributi, finanze e contravvenzioni',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item active'><span class='separator'>/</span>{$this->title}</li>",
];

?>
<div class="cmp-heading pb-3 pb-lg-4">
    <div class="categoryicon-top d-flex">
        <svg class="icon icon-success mr-10 big-lg-icon mb-1" aria-hidden="true">
            <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-check-circle"></use>
        </svg>
        <h1 class="title-xxxlarge">Pagamento effettuato</h1>
    </div>

    <p class="subtitle-small">Grazie abbiamo ricevuto il <strong>pagamento PA3028</strong> per la <strong>richiesta AN4059281
            pagamento multa.</strong></p>
    <p class="mt-4 mb-0">Importo: <strong>38,92 €</strong></p>
    <p class="m-0">Inviato il: <strong>21/07/2022</strong></p>
    <p class="pt-4 pt-lg-40 mb-0">Abbiamo inviato il riepilogo all’email:<br>
        <strong>giulia.rossi@gmail.com</strong>
    </p>
    <button type="button" class="btn btn-outline-primary fw-bold">
        <span class="rounded-icon">
            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                <use href="<?= Yii::getAlias("@web") ?>/bootstrap-italia/svg/sprites.svg#it-download"></use>
            </svg>
        </span>
        <span class="">Scarica la ricevuta (PDF 100KB)</span>
    </button>
</div>