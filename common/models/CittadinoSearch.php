<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cittadino;

/**
 * CittadinoSearch represents the model behind the search form of `common\models\Cittadino`.
 */
class CittadinoSearch extends Cittadino
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tipo_documento', 'eta', 'stato_civile'], 'integer'],
            [['nome', 'cognome', 'data_di_nascita', 'comune_di_nascita', 'documento_di_identita', 'last_login', 'email', 'updated', 'professione', 'comune_di_residenza', 'indirizzo_di_residenza', 'cittadinanza', 'codice_fiscale', 'telefono'], 'safe'],
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
        $query = Cittadino::find();

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
            'documento_di_identita' => $this->documento_di_identita,
            'tipo_documento' => $this->tipo_documento,
            'last_login' => $this->last_login,
            'updated' => $this->updated,
            'eta' => $this->eta,
            'stato_civile' => $this->stato_civile,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'data_di_nascita', $this->data_di_nascita])
            ->andFilterWhere(['like', 'comune_di_nascita', $this->comune_di_nascita])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'professione', $this->professione])
            ->andFilterWhere(['like', 'comune_di_residenza', $this->comune_di_residenza])
            ->andFilterWhere(['like', 'indirizzo_di_residenza', $this->indirizzo_di_residenza])
            ->andFilterWhere(['like', 'cittadinanza', $this->cittadinanza])
            ->andFilterWhere(['like', 'codice_fiscale', $this->codice_fiscale])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);

        return $dataProvider;
    }
}
