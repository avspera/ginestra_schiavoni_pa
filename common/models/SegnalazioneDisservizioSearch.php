<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SegnalazioneDisservizio;

/**
 * SegnalazioneDisservizioSearch represents the model behind the search form of `common\models\SegnalazioneDisservizio`.
 */
class SegnalazioneDisservizioSearch extends SegnalazioneDisservizio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_tipologia', 'luogo'], 'integer'],
            [['note', 'attachments', 'created_at', 'nome_richiedente', 'cognome_richiedente', 'email_richiedente'], 'safe'],
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
        $query = SegnalazioneDisservizio::find();

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
            'id_tipologia' => $this->id_tipologia,
            'luogo' => $this->luogo,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'nome_richiedente', $this->nome_richiedente])
            ->andFilterWhere(['like', 'cognome_richiedente', $this->cognome_richiedente])
            ->andFilterWhere(['like', 'email_richiedente', $this->email_richiedente]);

        return $dataProvider;
    }
}
