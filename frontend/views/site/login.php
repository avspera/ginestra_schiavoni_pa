<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

$spidLoginUrl = Yii::$app->params["spidLoginEndPoint"] . "?authorityId=" . Yii::$app->params["spidAuthorityId"] . 
                    "&scope=" . Yii::$app->params["spidScope"] . 
                    "&state=" . Yii::$app->params["spidState"]. 
                    "&response_type=".Yii::$app->params["spidResponseType"].
                    "&client_id=".Yii::$app->params["spidClientId"].
                    "&redirect_uri=".Yii::$app->params["spidRedirectUri"];

$this->registerJsFile(
    '@web/js/spid/spid-idps.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/spid/spid-sp-access-button.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<link href="<?= Yii::getAlias('@web') ?>/css/spid/spid-sp-access-button.min.css" rel="stylesheet">
<div class="site-login">

    <div class="card card-info">
        <div class="mt-5 offset-lg-3 col-lg-6">
            <div class="car-header">
                <h4 class="text-center">Effettua l'accesso</h4>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <a href="#" class="italia-it-button italia-it-button-size-l button-spid" spid-idp-button="#spid-idp-button-large-get" aria-haspopup="true" aria-expanded="false">
                        <span class="italia-it-button-icon">
                            <img src="<?= Yii::getAlias("@web/images") ?>/spid/spid-ico-circle-bb.svg" onerror="this.src='img/spid-ico-circle-bb.png'; this.onerror=null;" alt="" />
                        </span>
                        <span class="italia-it-button-text"> Entra con SPID </span>
                    </a>
                    <div id="spid-idp-button-large-get" class="spid-idp-button spid-idp-button-tip spid-idp-button-relative">
                        <ul id="spid-idp-list-large-root-get" class="spid-idp-button-menu" aria-labelledby="spid-idp" data-spid-remote>
                            <li><a class="dropdown-item" href="https://www.spid.gov.it">Maggiori informazioni</a></li>
                            <li><a class="dropdown-item" href="https://www.spid.gov.it/richiedi-spid">Non hai SPID?</a></li>
                            <li><a class="dropdown-item" href="https://www.spid.gov.it/serve-aiuto">Serve aiuto?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>