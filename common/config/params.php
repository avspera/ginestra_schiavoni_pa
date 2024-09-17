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
    'spidLoginEndPoint' => 'https://login.asfweb.it/connect/authorize',
    'spidAuthorityId' => 100,
    'spidScope' => 'openid+api+profile+offline_access',
    'spidState' => 'Bs9_ci1LOzEPNcWrzlATBgpeS9J_sx2k1l3_Wl8yBfU.7AM-8-gRJ74.webapp',
    'spidResponseType' => 'code',
    'spidClientId' => '{client_id}',
    'spidRedirectUri' => '{redirect_uri}',
    //SPID TEST
    'spidTestUrl' => "https://login-demo.asfweb.it/Account/Login?ReturnUrl=%2Fconnect%2Fauthorize%2Fcallback%3Fresponse_type%3Dcode%26client_id%3Dportalecittadino%26state%3DZTNPVVEwRUxGWEp3UjJiNDRiLmVjb2lYNGVxMGRPMGEya1cwV3J0RDkyR3Zt;https%25253A%25252F%25252Fpeople-demo.smartpa.cloud%25252Fsmartpa-citizens%26redirect_uri%3Dhttps%253A%252F%252Fbo-demo.smartpa.cloud%252Flogin.html%26scope%3Dopenid%2520profile%2520offline_access%2520api%26code_challenge%3DrKS3V0ypqYbZFeU0WXH4YlJQzKfRzy-SuxTyfdc99Rs%26code_challenge_method%3DS256%26nonce%3DZTNPVVEwRUxGWEp3UjJiNDRiLmVjb2lYNGVxMGRPMGEya1cwV3J0RDkyR3Zt%26authorityId%3D108",
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
