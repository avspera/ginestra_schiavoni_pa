<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RichiestaAppuntamento;

/**
 * RichiestaAppuntamentoSearch represents the model behind the search form of `common\models\RichiestaAppuntamento`.
 */
class RichiestaAppuntamentoSearch extends RichiestaAppuntamento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sede_riferimento'], 'integer'],
            [['email_richiedente', 'nome_richiedente', 'cf_richiedente', 'data', 'note', 'attachments'], 'safe'],
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
        $query = RichiestaAppuntamento::find();

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
            'data' => $this->data,
            'sede_riferimento' => $this->sede_riferimento,
        ]);

        $query->andFilterWhere(['like', 'email_richiedente', $this->email_richiedente])
            ->andFilterWhere(['like', 'nome_richiedente', $this->nome_richiedente])
            ->andFilterWhere(['like', 'cf_richiedente', $this->cf_richiedente])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'attachments', $this->attachments]);

        return $dataProvider;
    }
}
