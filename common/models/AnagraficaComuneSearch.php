<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AnagraficaComune;

/**
 * AnagraficaComuneSearch represents the model behind the search form of `common\models\AnagraficaComune`.
 */
class AnagraficaComuneSearch extends AnagraficaComune
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'civico'], 'integer'],
            [['email', 'pec', 'centralino', 'via', 'comune', 'provincia', 'responsabile_gestione_telematica'], 'safe'],
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
        $query = AnagraficaComune::find();

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
            'civico' => $this->civico,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pec', $this->pec])
            ->andFilterWhere(['like', 'centralino', $this->centralino])
            ->andFilterWhere(['like', 'via', $this->via])
            ->andFilterWhere(['like', 'comune', $this->comune])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'responsabile_gestione_telematica', $this->responsabile_gestione_telematica]);

        return $dataProvider;
    }
}
