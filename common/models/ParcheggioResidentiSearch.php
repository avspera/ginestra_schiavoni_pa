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
            [['id', 'qnt_auto', 'created_by', 'updated_by', 'payed'], 'integer'],
            [['created_at', 'updated_at', 'veicolo', 'targa'], 'safe'],
            [['indirizzo', 'cittadino',], 'string'],
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
            'cittadino' => $this->cittadino,
            'indirizzo' => $this->indirizzo,
            'qnt_auto' => $this->qnt_auto,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'price' => $this->price,
            'payed' => $this->payed,
        ]);

        return $dataProvider;
    }
}
