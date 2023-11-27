<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Assistenza;

/**
 * AssistenzaSearch represents the model behind the search form of `common\models\Assistenza`.
 */
class AssistenzaSearch extends Assistenza
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'motivo_richiesta', 'stato_richiesta', 'updated_by'], 'integer'],
            [['email_richiedente', 'nome_richiedente', 'cognome_richiedente', 'created_at', 'updated_at', 'note'], 'safe'],
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
        $query = Assistenza::find();

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
            'motivo_richiesta' => $this->motivo_richiesta,
            'stato_richiesta' => $this->stato_richiesta,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'email_richiedente', $this->email_richiedente])
            ->andFilterWhere(['like', 'nome_richiedente', $this->nome_richiedente])
            ->andFilterWhere(['like', 'cognome_richiedente', $this->cognome_richiedente])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
