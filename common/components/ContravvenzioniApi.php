<?php

/**
 * This is a bridge between current system and DedaGroup payment api
 * @version 1.0
 * @author Spera
 */

namespace common\components;

use common\models\Contravvenzione;
use Exception;
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

    /*
    * retrieves token
    * 1) check if current token is still valid
    * 2) If not, perform call to get a new one 
    * 3) save in session
    */
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

    /**
     * performs rest call to authentication method
     * saves token in jwt_token session variable
     */
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

    /**
     * parse json response
     */
    private function parseJsonResponse($response)
    {
        try {
            $formatter = new JsonParser;
            $parsedResponse = $formatter->parse($response, 'json');
            return $parsedResponse;
        } catch (yii\web\BadRequestHttpException $e) {
            return ["esito" => 'ko', "errore" => $e->getMessage(), "response" => $response];
        }
    }

    /**
     * retrieves multe tipo_dovuto Entity
     */
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

    /**
     * parse info data before sending to invia_multidovuto rest call
     * creates correct data structure
     * @param Object $model
     */
    public function parseInviaMultidovutoData($model)
    {
        $structure["pagatore"] = [
            'tipo_persona' => $model->tipo_persona,
            'nome' => $model->nome,
            'cognome' => $model->cognome,
            'cf' => $model->cf,
            'via' => $model->via,
            'civico' => $model->civico,
            'comune' => $model->comune,
            'cap' => $model->cap,
            'prov' => $model->prov,
            'nazione' => $model->nazione,
            'email' => $model->email
        ];

        $structure["versante"] = [
            "tipo_persona" => "F",
            "nome" => "Loris",
            "cognome" => "Pizzo",
            "cf" => "PGLSVT74A09E514A",
            "via" => null,
            "civico" => null,
            "comune" => null,
            "cap" => null,
            "prov" => null,
            "nazione" => null,
            "email" => null
        ];

        $structure["data_documento"] = null;
        $structure["numero_protocollo"] = "";
        $structure["data_protocollo"] = null;
        $structure["dettaglio_riga1"] = null;
        $structure["dettaglio_riga2"] = null;
        $structure["dettaglio_riga3"] = null;
        $structure["dettaglio_riga4"] = null;
        $structure["dettaglio_riga5"] = null;
        $structure["istruttore_procedimento"] = null;
        $structure["telefono_procedimento"] = null;
        $structure["email_procedimento"] = null;
        $structure["note"] = null;
        $structure["id_doc_civilianext"] = null;
        $structure["url_documento"] = null;

        $structure["rate"] = [
            [
                "tipo_rata" => "U",
                'id_univoco_versamento' => null,
                'scadenza' => date("Y-m-d", strtotime($model->data_accertamento)),
                // 'scadenza'  => '30/04/2024',
                'dovuti'    => [
                    [
                        //'tipo_dovuto' => $tipo_dovuto['out']["tipo_elemento"],
                        'tipo_dovuto' => 'multe',
                        'id_univoco_dovuto' => "1",
                        'causale' => $model->causale,
                        'importo' => floatval($model->amount),
                        'anno_competenza' => intval(date("Y"))
                    ]
                ],
            ],
            [
                "tipo_rata" => "U",
                'id_univoco_versamento' => null,
                'scadenza' => date("Y-m-d", strtotime($model->data_accertamento . "+ 60 days")),
                'dovuti'    => [
                    [
                        'tipo_dovuto' => 'multe',
                        'id_univoco_dovuto' => "2",
                        'causale' => $model->causale,
                        'importo' => floatval($model->amount),
                        'anno_competenza' => intval(date("Y"))
                    ]
                ],
            ]
        ];

        return $structure;
    }

    public function parseContentJsonResponse($content)
    {
        $out = ["esito" => 'ko', "errore" => '', "content" => []];
        // Base64 encoded ZIP file content
        $base64EncodedZip = $content;
        // Decode the base64 encoded ZIP content
        $zipContent = base64_decode($base64EncodedZip);
        // Create a temporary file to save the ZIP content
        $tempZipFile = tempnam(sys_get_temp_dir(), 'zip');
        file_put_contents($tempZipFile, $zipContent);
        // Create a ZipArchive instance to extract the ZIP file
        $zip = new \ZipArchive();
        if ($zip->open($tempZipFile) === TRUE) {
            // Extract the files from the ZIP archive
            $extractedFile = null;
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $extractedFile = $zip->getNameIndex($i);
            }

            if ($extractedFile) {
                // Extract the JSON file to a temporary location
                $extractedFilePath = tempnam(sys_get_temp_dir(), 'json');
                $jsonContent = $zip->getFromName($extractedFile);
                file_put_contents($extractedFilePath, $jsonContent);

                // Do whatever you need with the JSON file
                $response = file_get_contents($extractedFilePath);

                // Close the ZIP archive
                $zip->close();

                // Delete the temporary files
                unlink($tempZipFile);
                unlink($extractedFilePath);

                $out["content"] = json_decode($response, true);
                $out["esito"] = "ok";
            } else {
                $out["errore"] = "Risposta non pervenuta da DedaGroup [ERR-CONTR - 101]";
            }
        } else {
            $out["errore"] = "Impossibile leggere file zip risposta da DedaGroup [ERR-CONTR - 102]";
        }

        return $out;
    }
    /**
     * as suggested by Mimmo Carapella from ASFweb
     * rules to create the content_json structure
     * 1) create a json file
     * 2) put json content in file
     * 3) create a zip archive
     * 4) add json file to zip
     * 5) base64 encode zip file
     */
    private function createContentJson($params)
    {
        // $params = [
        //     [
        //         "pagatore" => [
        //             "tipo_persona" => "F",
        //             "nome" => "Verduzzo",
        //             "cognome" => "Verdi",
        //             "cf" => "vvvgkd34f33v123m",
        //             "via" => "via europa",
        //             "civico" => "34",
        //             "comune" => "torino",
        //             "cap" => "22205",
        //             "prov" => "to",
        //             "nazione" => "IT",
        //             "email" => "oooo@gmail.com"
        //         ],
        //         "versante" => [
        //             "tipo_persona" => "F",
        //             "nome" => "Loris",
        //             "cognome" => "Pizzo",
        //             "cf" => "PGLSVT74A09E514A",
        //             "via" => null,
        //             "civico" => null,
        //             "comune" => null,
        //             "cap" => null,
        //             "prov" => null,
        //             "nazione" => null,
        //             "email" => null
        //         ],
        //         "data_documento" => null,
        //         "numero_protocollo" => "",
        //         "data_protocollo" => null,
        //         "dettaglio_riga1" => null,
        //         "dettaglio_riga2" => null,
        //         "dettaglio_riga3" => null,
        //         "dettaglio_riga4" => null,
        //         "dettaglio_riga5" => null,
        //         "istruttore_procedimento" => null,
        //         "telefono_procedimento" => null,
        //         "email_procedimento" => null,
        //         "note" => null,
        //         "id_doc_civilianext" => null,
        //         "url_documento" => null,
        //         "rate" => [
        //             [
        //                 "tipo_rata" => "U",
        //                 "id_univoco_versamento" => "",
        //                 "scadenza" => "29/04/2019",
        //                 "dovuti" => [
        //                     [
        //                         "tipo_dovuto" => "tari",
        //                         "id_univoco_dovuto" => "1",
        //                         "causale" => "descrizione della causale r2d1",
        //                         "importo" => 1
        //                     ],
        //                 ]
        //             ],
        //             //i need 2 elements. one expires in 5 days from delivery, the other one will replace it
        //             [
        //                 "tipo_rata" => "U",
        //                 "id_univoco_versamento" => "",
        //                 "scadenza" => "29/04/2019",
        //                 "dovuti" => [
        //                     [
        //                         "tipo_dovuto" => "tari",
        //                         "id_univoco_dovuto" => "1",
        //                         "causale" => "descrizione della causale r2d1",
        //                         "importo" => 1
        //                     ],
        //                 ]
        //             ]
        //         ]
        //     ],
        // ];

        $params = json_encode($params);

        if ($params === false) return false;

        $filenameJson = 'content_json.json';
        $file = fopen($filenameJson, 'w+') or die("File not found");
        fwrite($file, $params);
        fclose($file);

        // Create a ZIP archive
        $zip = new \ZipArchive();
        $zipFileName = 'content_json.zip';
        $out = false;
        if ($zip->open($zipFileName, \ZipArchive::CREATE) === TRUE) {
            // Add the JSON file to the ZIP archive
            $zip->addFile($filenameJson);
            $zip->close();

            // Encode the ZIP file in Base64
            $base64EncodedZip = base64_encode(file_get_contents($zipFileName));

            // Output the Base64 encoded ZIP file
            $out = $base64EncodedZip;

            // Clean up: delete the JSON file and the ZIP file
            unlink($filenameJson);
            unlink($zipFileName);
        }

        return $out;
        /**
         * end of content_json rules
         */
    }
    /**
     * performs invia_multidovuto action (backend to insert a new multa into dedagroup system)
     * @param Array $params
     */
    public function inviaMultidovuto($params, $internalId)
    {
        $token = $this->token;

        $url = Yii::$app->params["testEndPoint"] . "invia_multidovuto";

        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $contentJson = $this->createContentJson($params);

        if ($contentJson === false) return false;

        // $compressedParams   = gzcompress(base64_encode($params), 9);
        $response = $curl->setPostParams([
            'applicazione'  => 'pagamenti',
            'numero'        => 2,
            'nome_flusso'   => "contravvenzione_" . $internalId, //singolo pagamento
            'caricamento_da_confermare' => 'false',
            'cancellabile' => '0',
            'content_json'  => $contentJson,
        ])->post($url);

        $parsedResponse = $this->parseJsonResponse($response);
        return $parsedResponse;
    }

    /**
     * performs multiple actions to single multiflusso (previously inserted in system)
     * you can call for info, update, delete entity
     * @param Object $model
     * @param String $action (info|update|delete)
     */
    public function getGestioneMultidovuto($model, $action)
    {
        $token = $this->token;
        $url = Yii::$app->params["testEndPoint"] . "gestione_multidovuto";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        $response = $curl->setPostParams([
            'applicazione'  => 'pagamenti',
            'nome_flusso'   => $model->nome_flusso,
            'id_flusso'     => $model->id_flusso,
            'operazione'    => $action
        ])->post($url);

        return $this->parseJsonResponse($response);
    }

    public function getStatoPagamento($model)
    {
        $token = $this->token;
        $url = Yii::$app->params["testEndPoint"] . "stato_pagamenti";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
        $response = $curl->setPostParams([
            'applicazione'      => 'pagamenti',
            'iuv'               => $model->nome_flusso,
            'id_univoco_dovuto' => $model->id_univoco_dovuto,
            'tipo_dovuto'       => 'multe'
        ])->post($url);

        return $this->parseJsonResponse($response);
    }

    public function modificaDovuto($model)
    {
        $token = $this->token;

        $url = Yii::$app->params["testEndPoint"] . "modifica_dovuto";

        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
        ]);

        $response = $curl->setPostParams([
            'applicazione'  => 'pagamenti',
            'tipo_dovuto'   => 'multe',
            'id_univoco_dovuto' => $model->id_univoco_dovuto,
            'iuv'               => $model->id_univoco_versamento,
            'causale'           => $model->causale,
            'importo'           => $model->amount,
            'scadenza'          => $model->scadenza
        ])->post($url);

        $parsedResponse = $this->parseJsonResponse($response);

        return $parsedResponse;
    }

    public function statoPagamenti($model)
    {
        $token = $this->token;
        $url = Yii::$app->params["testEndPoint"] . "stato_pagamenti";
        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $response = $curl->setPostParams([
            'applicazione'      => 'pagamenti',
            'tipo_dovuto'       => 'multe',
            'id_univoco_dovuto' => $model->id_univoco_dovuto,
            'iuv'               => $model->id_univoco_versamento,
            'cf_pagatore'       => $model->cf,
            'cognome_pagatore'  => $model->cognome,
            'nome_pagatore'     => $model->nome,
        ])->post($url);

        $parsedResponse = $this->parseJsonResponse($response);

        return $parsedResponse;
    }

    public function scaricaAvviso($iuv)
    {
        $token = $this->token;

        $url = Yii::$app->params["testEndPoint"] . "scarica_avviso";

        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $response = $curl->setGetParams([
            'applicazione' => 'pagamenti',
            'iuv' => $iuv
        ])->get($url);

        if ($response == "Avviso non disponibile") {
            return ["esito" => "ko", "errore" => "Impossibile scaricare avviso"];
        } else {
            $pdfFilePath    = Yii::getAlias("@webroot") . "/avvisi/avviso" . $iuv . "_" . date("Y-m-dH:i:s") . ".pdf";
            $pdfLink        = "/avvisi/avviso" . $iuv . "_" . date("Y-m-dH:i:s") . ".pdf";
            $file = fopen($pdfFilePath, 'w');
            fwrite($file, $response);
            fclose($file);

            return is_file($pdfFilePath) ? ["esito" => "ok", "path" => $pdfLink] : ["esito" => "ko", "errore" => "Impossibile scaricare avviso"];
        }
    }

    public function avviaPagamento($model)
    {
        $token = $this->token;

        $url = Yii::$app->params["testEndPoint"] . "avvia_pagamento";

        $curl = new curl\Curl();
        $curl->setHeaders([
            'Authorization' => "Bearer " . $token["access_token"],
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);

        $response = $curl->setGetParams([
            'applicazione' => 'pagamenti',
            'iuv'       => $model->id_univoco_versamento,
            'url_ok'    => "esito-ok",
            'url_ko'    => "esito-ko",
            'sso'       => 1,
            'trash_pag' => 1,
        ])->get($url);

        $parsedResponse = $this->parseJsonResponse($response);

        return $parsedResponse;
    }
}
