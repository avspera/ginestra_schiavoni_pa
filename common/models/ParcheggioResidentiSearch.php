<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ParcheggioResidenti;

/**
 * ParcheggioResidentiSearch represents the model behind the search form of `common\models\ParcheggioResidenti`.
 */
class ParcheggioResidentiSearch extends ParcheggioResidenti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'payed'], 'integer'],
            [['created_at', 'updated_at', 'veicolo'], 'safe'],
            [['id_cittadino',], 'string'],
            [['price'], 'number'],
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
        $query = ParcheggioResidenti::find();

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
            'id_cittadino' => $this->id_cittadino,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'price' => $this->price,
            'payed' => $this->payed,
        ]);

        if (!empty($this->stato_richiesta)) {
            $query->andFilterWhere(["stato_richiesta" => $this->stato_richiesta]);
        } else {
            $query->andFilterWhere(["<>", "stato_richiesta", \common\components\Utils::getStatoRichiestaFlipped("cancellata")]);
        }

        return $dataProvider;
    }
}
