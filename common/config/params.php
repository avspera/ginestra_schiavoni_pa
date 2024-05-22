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
    //SPID
    'spidLoginEndPoint' => 'https://login.asfweb.it/connect/authorize',
    'spidAuthorityId' => 100,
    'spidScope' => 'openid+api+profile+offline_access',
    'spidState' => 'Bs9_ci1LOzEPNcWrzlATBgpeS9J_sx2k1l3_Wl8yBfU.7AM-8-gRJ74.webapp',
    'spidResponseType' => 'code',
    'spidClientId' => '{client_id}',
    'spidRedirectUri' => '{redirect_uri}',
    'something' => ''
];
