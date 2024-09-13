<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccessoAtti;

/**
 * AccessoAttiSearch represents the model behind the search form of `common\models\AccessoAtti`.
 */
class AccessoAttiSearch extends AccessoAtti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cittadino'], 'integer'],
            [['numero_protocollo', 'oggetto_richiesta', 'data_richiesta', 'stato_richiesta', 'data_risposta', 'note', 'documento_rilasciato', 'data_creazione', 'data_aggiornamento'], 'safe'],
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
        $query = AccessoAtti::find();

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
            'data_richiesta' => $this->data_richiesta,
            'data_risposta' => $this->data_risposta,
            'data_creazione' => $this->data_creazione,
            'data_aggiornamento' => $this->data_aggiornamento,
        ]);

        $query->andFilterWhere(['like', 'numero_protocollo', $this->numero_protocollo])
            ->andFilterWhere(['like', 'oggetto_richiesta', $this->oggetto_richiesta])
            ->andFilterWhere(['like', 'stato_richiesta', $this->stato_richiesta])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'documento_rilasciato', $this->documento_rilasciato]);

        return $dataProvider;
    }
}
