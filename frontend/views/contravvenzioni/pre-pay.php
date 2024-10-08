<?php
$this->title = "Contravvenzioni - Scegli metodo di pagamento";

use yii\helpers\Url;

?>
<div id="portal_main" class="col-lg-12">
    
<div id="portal_content" class="pagamenti ">
        <div class="pagamenti_layout">
            <div id="pre_auth_pagamenti" class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <legend>Sezione Pagamenti OnLine e PagoPA.</legend>

                    <p>In questa sezione sono disponibili le funzioni che l'ente ha previsto per i pagamenti.</p>
                    <p>
                        E' possibile procedere effettuando l'accesso o direttamente dai link riportati su questa pagina.
                    </p>
                    <p>
                        Procedendo senza autenticazione non sono disponibili tutte le funzioni riservate nella sezione privata, come la consultazione dello storico dei pagamenti o la possibilità di salvare le posizioni debitorie per poi riprenderle in un secondo momento, ma soprattutto NON sarà possibile cumulare più posizioni debitorie ed effettuare un pagamento unico con un'unica posizione.
                    </p>
                    <p>
                        <strong>Accesso autenticato</strong><br>
                        Il sistema è organizzato con il carrello delle posizioni debitorie (Carrello dei pagamenti) e potrai quindi procedere con il pagamento cumulativo anche di più posizioni (fino ad un massimo di 5) pagando un'unica commissione di incasso se prevista dalla modalità scelta.
                    </p>
                    <p>
                        Accedendo troverai tutte le posizioni inserite dall'Ente e quelle che potrai generare tu, utilizzando la funzione “Nuovo pagamento” (pagamento spontaneo) oppure utilizzando uno dei servizi online messi a disposizione dell'ente che prevede un pagamento.
                    </p>
                    <p>
                        E' inoltre possibile pagare “Offline” stampando l'avviso di pagamento e recandosi, fisicamente o virtualmente, presso uno dei <a href="https://www.pagopa.gov.it/it/prestatori-servizi-di-pagamento/" target="_blank" class="nomodal">Prestatore di Servizio di Pagamento</a> (PSP) abilitati o mediante il circuito CBILL.
                    </p>
                    <p>
                        E' inoltre sempre disponibile l'elenco dei pagamenti effettuati con la possibilità di stampare la ricevuta. Questo archivio è disponibile anche per i pagamenti effettuati “Offline”: paghi presso il PSP e la ricevuta è disponibile nella tua sezione riservata del portale.
                    </p>

                    <p class="text-center mt20 mb20"><a href="<?= Url::to(["site/login"]) ?>" class="btn btn-primary">Vai alla pagina di autenticazione</a></p>

                    <p class="text-center mt20 mb20">
                        <strong>È possibile procedere con i pagamenti anche senza autenticazione.</strong><br><br>
                        <a class="btn btn-primary" href="<?= Url::to(["contravvenzioni/pay", "id" => $id]) ?>">Paga avviso senza autenticazione</a>
                    </p>

                </div>

            </div>

        </div>
    </div>


    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div id="myDialog" class="modal hide fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Chiudi</button>
                </div>
            </div>
        </div>
    </div>

</div>