<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'bsVersion' => '5.x',
    //VARS
    'codiceCatastale'   => 'E034',
    'nomeComune'        => "Ginestra degli Schiavoni",
    //PAYMENT
    'payUsernameTest'   => "civilia_test@jwt.it",
    'payPasswordTest'   => "PswCivilia1",
    'payGrantType'      => 'password',
    'payClientId'       => 'uin892IO!',
    'testEndPoint'      => 'http://civilianext.soluzionipa.it/portal/servizi/pagamenti/ws/10/',
    'prodEndPoint'      => 'https://www.comune.ginestradeglischiavoni.bn.it/portal/servizi/pagamenti/ws/10/',
    'paymentAuthUrlTest' => 'https://starttest.soluzionipa.it/auth_hub/oauth/token/',
    'paymentAuthUrl'    => 'https://start.soluzionipa.it/auth_hub/oauth/token/',
    'pagoPaPayTest'     => "https://uat.checkout.pagopa.it",
    'pagoPaPay'         => "https://checkout.pagopa.it",
    //SPID
    "spidParamsProd" => [
        'spidLoginEndPoint' => 'https://login.asfweb.it/connect/authorize',
        'authorityId' => 100,
        'scope' => 'openid+api+profile+offline_access',
        'state' => 'Bs9_ci1LOzEPNcWrzlATBgpeS9J_sx2k1l3_Wl8yBfU.7AM-8-gRJ74.webapp',
        'response_type' => 'code',
        'client_id' => '{client_id}',
        'redirect_uri' => '{redirect_uri}',
    ],
    //SPID TEST
    "spidParamsTest" => [
        'spidLoginEndPoint' => "https://login-demo.asfweb.it/connect/authorize",
        "authorityId" => 108,
        "scope" => "openid+api+profile+offline_access",
        "state" => "",
        "response_type" => "code",
        "client_id" => "appsprojectsclient",
        "redirect_uri" => "https://comuneginestradeglischiavonibn.it"
    ],
    'spidJsonUser' => [
        "id" => 1,
        'fullname' => "Giulia Rossi",
        'name' => "Giulia",
        "surname" => "Rossi",
        'codice_fiscale' => 'GLABNC72H25H501Y',
        'indirizzo' => 'Via Roma 16, 00100 Roma, It',
        'domicilio' => "Piazza Risorgimento 16, 00100 Roma, It",
        'data_di_nascita' => '1987-01-18',
        'luogo_di_nascita' => "Salerno",
        'sesso' => "Donna",
        'telefono' => "+39 331 1234567",
        'email' => "prova@prova.it"
    ]
];
