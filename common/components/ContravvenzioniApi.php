<?php

namespace common\components;

use Yii;
use linslin\yii2\curl;
use yii\web\JsonParser;

class ContravvenzioniApi
{
    public $ambiente;
    public $token = [];

    public function __construct($ambiente = "test")
    {
        $this->ambiente = $ambiente;
        $this->token = $this->getToken();
    }

    private function getToken()
    {
        $token = Yii::$app->session->get("jwt_token");
        $getNewToken = false;
        if (!empty($token)) {
            //[expires_in] => 1799 [created_at] => 1706020921
            $expiresAt = date("Y-m-d H:i:s", $token["created_at"] + $token["expires_in"]);
            if (date("Y-m-d H:i:s", strtotime($expiresAt)) < date("Y-m-d H:i:s")) {
                $getNewToken = true;
            }
        } else {
            $getNewToken = true;
        }

        if ($getNewToken) {
            $token = $this->authenticateWithJwt();
        }

        return $token;
    }

    private function authenticateWithJwt()
    {
        $ambiente = $this->ambiente;
        $url        = $ambiente !== "test" ? Yii::$app->params["paymentAuthUrl"] : Yii::$app->params["paymentAuthUrlTest"];
        $username   = $ambiente !== "test" ? Yii::$app->params["payUsername"] : Yii::$app->params["payUsernameTest"];
        $password   = $ambiente !== "test" ? Yii::$app->params["payPassword"] : Yii::$app->params["payPasswordTest"];
        $grantType  = Yii::$app->params["payGrantType"];
        //Init curl
        $curl = new curl\Curl();
        $response = $curl
            ->setPostParams([
                'username' => $username,
                'password' => $password,
                'grant_type' => $grantType
            ])->post($url);

        $decodedResponse = $this->parseJsonResponse($response);

        if (!empty($decodedResponse)) {
            Yii::$app->session->set("jwt_token", $decodedResponse);
            return $decodedResponse;
        }

        return false;
    }

    private function parseJsonResponse($response)
    {
        try {
            $formatter = new JsonParser;
            $parsedResponse = $formatter->parse($response, 'json');
            return $parsedResponse;
        } catch (yii\web\BadRequestHttpException $e) {
            return ["esito" => 'ko', "errore" => $response];
        }
    }

    public function getTipoDovuti()
    {
        $token = $this->token;

        $url = Yii::$app->params["testEndPoint"] . "/tipi_dovuto";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        $response = $curl->get($url);
        $parsedResponse = $this->parseJsonResponse($response);
        $out = [];
        if ($parsedResponse) {
            foreach ($parsedResponse["tipi_dovuto"] as $item) {
                if ($item["tipo_elemento"] == "multe") {
                    $out = $item;
                }
            }
        }

        return [
            "esito"     => $parsedResponse["esito"],
            "errore"    => isset($parsedResponse["errore"]) ? $parsedResponse["errore"] : NULL,
            "out"       => $out
        ];
    }
}
