<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AlboPretorio;
use linslin\yii2\curl;
use yii\web\JsonParser;
use yii\data\ArrayDataProvider;

/**
 * AlboPretorioSearch represents the model behind the search form of `common\models\AlboPretorio`.
 */
class AlboPretorioSearch extends AlboPretorio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numero_atto', 'id_tipologia', 'numero_affissione', 'created_by', 'updated_by', 'progressivo'], 'integer'],
            [['anno', 'data_pubblicazione', 'created_at', 'updated_at', 'attachments', 'note', 'oggetto', 'data_fine_pubblicazione'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AlboPretorio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'numero_atto' => $this->numero_atto,
            'anno' => $this->anno,
            'id_tipologia' => $this->id_tipologia,
            'numero_affissione' => $this->numero_affissione,
            'data_pubblicazione' => $this->data_pubblicazione,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'progressivo' => $this->progressivo
        ]);

        $query->andFilterWhere([">=", "data_fine_pubblicazione", date("Y-m-d")]);

        $query->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'oggetto', $this->oggetto]);

        return $dataProvider;
    }

    /**
     * search all items by curl
     */
    public function searchCurl($params)
    {
        $url = 'https://api.trasparenzapa.it/Albo/Pubblicazioni?comune=' . \Yii::$app->params["codiceCatastale"];
        $params["storico"] = isset($params["storico"]) ? (string) $params["storico"] : 'false';
        $url .= "&storico=" . $params["storico"];
        if (!empty($params["AlboPretorioSearch"]["id_tipologia"])) {
            $url .= "&tipoDocumento=" . $params["AlboPretorioSearch"]["id_tipologia"];
        }
        if (!empty($params["AlboPretorioSearch"]["oggetto"])) {
            $url .= "&oggetto=" . urlencode($params["AlboPretorioSearch"]["oggetto"]);
        }
        
        //Init curl
        $curl = new curl\Curl();
        $response = $curl->get($url);
        $formatter = new JsonParser();
        $decodedResponse = $formatter->parse($response, 'json');
        $items = [];
        foreach ($decodedResponse as $response) {
            $items[] = $this->parseAtto($response);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $items,
            'key' => 'numero_atto',
            'sort' => [
                'attributes' => ['numero_atto'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],

        ]);

        return $dataProvider;
    }

    private function parseAtto($item)
    {
        $formattedItem                  = new AlboPretorio();
        $formattedItem->id              = $item["id"];
        $formattedItem->numero_atto     = $item["numero"];
        $formattedItem->id_tipologia    = $item["idTipo"];
        $formattedItem->created_at      = $item["data"];
        $formattedItem->updated_at      = isset($item["dataUltimaModifica"]) ? $item["dataUltimaModifica"] : NULL;
        $formattedItem->data_pubblicazione = $item["dataPubblicazione"];
        $formattedItem->data_fine_pubblicazione = $item["dataFine"];
        $formattedItem->anno            = $item["anno"];
        $formattedItem->oggetto         = $item["oggetto"];
        $formattedItem->attachments     = isset($item["allegati"]) ? json_encode($item["allegati"]) : NULL;
        $formattedItem->note            = isset($item["note"]) ? $item["note"] : NULL;
        $formattedItem->data_eliminazione = isset($item["dataEliminazione"]) ? $item["dataEliminazione"] : NULL;
        $formattedItem->eliminato_da    = isset($item["eliminatoDa"]) ? $item["eliminatoDa"] : NULL;
        $formattedItem->updated_by      = isset($item["modificatoDa"]) ? $item["modificatoDa"] : NULL;
        $formattedItem->progressivo     = isset($item["progressivo"]) ? $item["progressivo"] : NULL;
        return $formattedItem;
    }

    /**
     * get single item by curl
     */
    public function getCurl($id)
    {
        //Init curl
        $curl = new curl\Curl();
        $response = $curl->get('https://api.trasparenzapa.it/Albo/Pubblicazione/' . $id . '?comune=' . \Yii::$app->params["codiceCatastale"]);
        $formatter = new JsonParser();
        $decodedResponse = $formatter->parse($response, 'json');
        return $this->parseAtto($decodedResponse);
    }
}
