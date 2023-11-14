<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contravvenzione;

/**
 * ContravvenzioneSearch represents the model behind the search form of `common\models\Contravvenzione`.
 */
class ContravvenzioneSearch extends Contravvenzione
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'punti_patente', 'payed'], 'integer'],
            [['amount'], 'number'],
            [['articolo_codice', 'data_accertamento', 'created_at', 'targa', 'data_pagamento', 'ricevuta_pagamento'], 'safe'],
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
        $query = Contravvenzione::find();

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
            'amount' => $this->amount,
            'data_accertamento' => $this->data_accertamento,
            'created_at' => $this->created_at,
            'punti_patente' => $this->punti_patente,
            'payed' => $this->payed,
            'data_pagamento' => $this->data_pagamento,
        ]);

        $query->andFilterWhere(['like', 'articolo_codice', $this->articolo_codice])
            ->andFilterWhere(['like', 'targa', $this->targa])
            ->andFilterWhere(['like', 'ricevuta_pagamento', $this->ricevuta_pagamento]);

        return $dataProvider;
    }
}
