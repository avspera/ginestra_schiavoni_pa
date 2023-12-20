<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

$path = getcwd();
$relativePath = dirname($path, 3);

require_once($relativePath . "/spid-cie-php/spid-php.php");

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';

$spidsdk = new SPID_PHP();

die;
if (!$spidsdk->isAuthenticated()) {
    if (!isset($_GET['idp'])) {
        $spidsdk->insertSPIDButtonCSS();
        $spidsdk->insertSPIDButton("L");
        $spidsdk->insertSPIDButtonJS();
    } else {
        $spidsdk->login($_GET['idp'], 1);
    }
} else {
    foreach ($spidsdk->getAttributes() as $attribute => $value) {
        echo "<p>" . $attribute . ": <b>" . $value[0] . "</b></p>";
    }

    echo "<hr/><p><a href='" . $spidsdk->getLogoutURL() . "'>Logout</a></p>";
}

// shortname of IdP, same as the name of corresponding IdP metadata file, without .xml
$idpName = 'testenv';
// index of assertion consumer service as per the SP metadata (sp_assertionconsumerservice in settings array)
$assertId = 0;
// index of attribute consuming service as per the SP metadata (sp_attributeconsumingservice in settings array)
$attrId = 1;

// Generate the login URL and redirect to the IdP login page
$sp->login($idpName, $assertId, $attrId);
?>
<div class="site-login">

    <div class="card card-info">
        <div class="mt-5 offset-lg-3 col-lg-6">
            <div class="car-header">
                <?= Html::img(Yii::getAlias("@web") . "/images/logo.png", ["class" => "mx-auto d-block"]) ?>
                <h4 class="text-center">Effettua l'accesso</h4>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Rimani connesso") ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-xs btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>