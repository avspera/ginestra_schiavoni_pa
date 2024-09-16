<?php

use common\components\ContravvenzioniApi;

class Pagamento
{

    public static function generate($model, $rataModel = NULL)
    {
        $api = new ContravvenzioniApi();
        $token = $api->token;
        $out  = [
            "status" => 100,
            'msg' => ""
        ];

        if (empty($token)) {
            $out["msg"] = "Errore critico: impossibile connettersi a sistema DedaGroup";
            return $out;
        }

        $tipo_dovuto = $api->getTipoDovuti();

        if ($tipo_dovuto["esito"] == "ko") {
            $out["msg"] = "Errore critico: " . $tipo_dovuto["errore"];
            return $out;
        }

        //$model = $this->findModel($id);

        $structure = $api->parseInviaMultidovutoData($model);

        $response = $api->inviaMultidovuto($structure, $model->id);

        if ($response["esito"] == "ko") {
            $out["msg"] = "Errore critico: " . json_encode($response["errore"]);
            return $out;
        }

        $decodedResponse = $api->parseContentJsonResponse($response["content_json"]);
        if ($decodedResponse["esito"] == "ko") {
            $out["msg"] = "Errore critico: " . $decodedResponse["errore"];
            return $out;
        }

        $rate   = $decodedResponse["content"][0]["rate"];
        $esito  = "ok";

        foreach ($rate as $item) {
            $rata                           = new $rataModel;
            $rata->id_contravvenzione       = $model->id;
            $rata->id_univoco_versamento    = $item["id_univoco_versamento"];
            $rata->id_univoco_dovuto        = isset($item["dovuti"][0]["id_univoco_versamento"]) ? $item["dovuti"][0]["id_univoco_dovuto"] : NULL;
            $rata->importo                  = isset($item["dovuti"][0]["importo"]) ? $item["dovuti"][0]["importo"] : 0;
            $rata->causale                  = isset($item["dovuti"][0]["causale"]) ? $item["dovuti"][0]["causale"] : NULL;
            $rata->stato                    = $model->stato;
            $rata->scadenza                 = isset($item["dovuti"][0]["scadenza"]) ? $item["dovuti"][0]["scadenza"] : NULL;

            $rata->save(false);
        }

        $model->id_flusso   = $response["id_flusso"];
        $model->nome_flusso = $response["nome_flusso"];

        if (!$model->save(false)) {
            $esito = "ko";
        }
        if ($esito == "ok") {
            $out["status"]  = 200;
            $out["msg"]     = "Operazione completata correttamente";
        } else {
            $out["msg"]     = "Ops...c'è stato qualche problema. [ERR-PAGAMENTO 103]";
        }

        return $out;
    }
}
