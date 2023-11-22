<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AttoDiMatrimonio;

/**
 * AttoDiMatrimonioSearch represents the model behind the search form of `common\models\AttoDiMatrimonio`.
 */
class AttoDiMatrimonioSearch extends AttoDiMatrimonio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_coniuge_uno', 'id_coniuge_due', 'id_residenza', 'created_by', 'updated_by', 'tipo_rito', 'regime_matrimoniale', 'titolo_studio_coniuge_uno', 'titolo_studio_coniuge_due', 'posizione_professionale_coniuge_uno', 'posizione_professionale_coniuge_due', 'condizione_non_professionale_coniuge_uno', 'condizione_non_professionale_coniuge_due'], 'integer'],
            [['padre_coniuge_uno', 'madre_coniuge_uno', 'padre_coniuge_due', 'madre_coniuge_due', 'created_at', 'updated_at', 'luogo_matrimonio'], 'safe'],
            [['data_matrimonio'], 'string']
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
        $query = AttoDiMatrimonio::find();

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
            'id_coniuge_uno' => $this->id_coniuge_uno,
            'id_coniuge_due' => $this->id_coniuge_due,
            'data_matrimonio' => $this->data_matrimonio,
            'id_residenza' => $this->id_residenza,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'tipo_rito' => $this->tipo_rito,
            'regime_matrimoniale' => $this->regime_matrimoniale,
            'titolo_studio_coniuge_uno' => $this->titolo_studio_coniuge_uno,
            'titolo_studio_coniuge_due' => $this->titolo_studio_coniuge_due,
            'posizione_professionale_coniuge_uno' => $this->posizione_professionale_coniuge_uno,
            'posizione_professionale_coniuge_due' => $this->posizione_professionale_coniuge_due,
            'condizione_non_professionale_coniuge_uno' => $this->condizione_non_professionale_coniuge_uno,
            'condizione_non_professionale_coniuge_due' => $this->condizione_non_professionale_coniuge_due,
        ]);

        $query->andFilterWhere(['like', 'padre_coniuge_uno', $this->padre_coniuge_uno])
            ->andFilterWhere(['like', 'madre_coniuge_uno', $this->madre_coniuge_uno])
            ->andFilterWhere(['like', 'padre_coniuge_due', $this->padre_coniuge_due])
            ->andFilterWhere(['like', 'madre_coniuge_due', $this->madre_coniuge_due])
            ->andFilterWhere(['like', 'luogo_matrimonio', $this->luogo_matrimonio]);

        return $dataProvider;
    }
}
