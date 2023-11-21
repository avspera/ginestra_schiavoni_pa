<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ValutazioneServizio;

/**
 * ValutazioneServizioSearch represents the model behind the search form of `common\models\ValutazioneServizio`.
 */
class ValutazioneServizioSearch extends ValutazioneServizio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cittadino', 'overall_rating', 'satisfaction_reason', 'angry_reason'], 'integer'],
            [['nome_servizio', 'notes'], 'safe'],
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
        $query = ValutazioneServizio::find();

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
            'overall_rating' => $this->overall_rating,
            'satisfaction_reason' => $this->satisfaction_reason,
            'angry_reason' => $this->angry_reason,
        ]);

        $query->andFilterWhere(['like', 'nome_servizio', $this->nome_servizio])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
