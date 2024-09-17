<div class="row justify-content-center">
    <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav
                class="navbar it-navscroll-wrapper navbar-expand-lg"
                aria-label="INFORMAZIONI RICHIESTE"
                data-bs-navscroll="">
                <div class="navbar-custom" id="navbarNavProgress">
                    <div class="menu-wrapper">
                        <div class="link-list-wrapper">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <span class="accordion-header" id="accordion-title-one">
                                        <button
                                            class="accordion-button pb-10 px-3"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-one"
                                            aria-expanded="true"
                                            aria-controls="collapse-one">
                                            INFORMAZIONI RICHIESTE
                                            <svg class="icon icon-xs right">
                                                <use
                                                    href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </button>
                                    </span>
                                    <div class="progress">
                                        <div
                                            class="progress-bar it-navscroll-progressbar"
                                            role="progressbar"
                                            aria-valuenow="0"
                                            aria-valuemin="0"
                                            aria-valuemax="100"
                                            style="width: 0%"></div>
                                    </div>
                                    <div
                                        id="collapse-one"
                                        class="accordion-collapse collapse show"
                                        role="region"
                                        aria-labelledby="accordion-title-one">
                                        <div class="accordion-body">
                                            <ul class="link-list" data-element="page-index">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#durata-choice">
                                                        <span>Scegli durata</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#pagamento-choice">
                                                        <span>Pagamento</span>
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
        <div class="steppers-content" aria-live="polite">
            <div class="it-page-sections-container">
                <p class="text-paragraph-small mb-40">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>

                <section class="it-page-section" id="durata-choice">
                    <div class="cmp-card mb-40">
                        <div class="card has-bkg-grey shadow-sm p-big">
                            <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                <div class="d-flex">
                                    <h2 class="title-xxlarge mb-1 icon-required">Durata permesso</h2>
                                </div>
                                <p class="subtitle-small mb-0 mb-4">Indica la durata del permesso</p>
                            </div>
                            <div class="card-body p-0">
                                <div class="cmp-card-radio">
                                    <div class="card card-teaser">
                                        <div class="card-body">
                                            <div class="form-check m-0">
                                                <div class="radio-body border-bottom border-light">
                                                    <input checked name="ParcheggioResidenti[durata]" type="radio" id="parcheggioresidenti-durata" required value="3">
                                                    <label for="parcheggioresidenti-durata">1 anno</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="it-page-section" id="pagamento-choice">
                    <div class="cmp-card mb-40">
                        <div class="card has-bkg-grey shadow-sm p-big">
                            <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                <div class="d-flex">
                                    <h2 class="title-xxlarge mb-1 icon-required">Pagamento</h2>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="cmp-card-radio">
                                    <div class="card card-teaser">
                                        <div class="card-body">
                                            <p class="subtitle-small mb-0 mb-4">Il servizio è gratuito e non prevede alcun costo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

</div>