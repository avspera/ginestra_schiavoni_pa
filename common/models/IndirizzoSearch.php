<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Indirizzo;

/**
 * IndirizzoSearch represents the model behind the search form of `common\models\Indirizzo`.
 */
class IndirizzoSearch extends Indirizzo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cittadino', 'id_atto_matrimonio', 'cap', 'type'], 'integer'],
            [['via', 'civico', 'citta', 'provincia'], 'safe'],
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
        $query = Indirizzo::find();

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
            'id_atto_matrimonio' => $this->id_atto_matrimonio,
            'cap' => $this->cap,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'via', $this->via])
            ->andFilterWhere(['like', 'civico', $this->civico])
            ->andFilterWhere(['like', 'citta', $this->citta])
            ->andFilterWhere(['like', 'provincia', $this->provincia]);

        return $dataProvider;
    }
}
