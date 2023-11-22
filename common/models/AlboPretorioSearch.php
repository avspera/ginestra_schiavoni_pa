<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AlboPretorio;

/**
 * AlboPretorioSearch represents the model behind the search form of `common\models\AlboPretorio`.
 */
class AlboPretorioSearch extends AlboPretorio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numero_atto', 'id_tipologia', 'numero_affissione', 'created_by', 'updated_by'], 'integer'],
            [['anno', 'data_pubblicazione', 'created_at', 'updated_at', 'attachments', 'note', 'titolo', 'data_fine_pubblicazione'], 'safe'],
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
        $query = AlboPretorio::find();

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
            'numero_atto' => $this->numero_atto,
            'anno' => $this->anno,
            'id_tipologia' => $this->id_tipologia,
            'numero_affissione' => $this->numero_affissione,
            'data_pubblicazione' => $this->data_pubblicazione,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere([">=", "data_fine_pubblicazione", date("Y-m-d")]);

        $query->andFilterWhere(['like', 'attachments', $this->attachments])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'titolo', $this->titolo]);

        return $dataProvider;
    }
}
