<?php

namespace common\models;

use Yii;
use common\components\Utils;

/**
 * This is the model class for table "contravvenzione".
 *
 * @property int $id
 * @property float $amount
 * @property string $articolo_codice
 * @property string $data_accertamento
 * @property string $orario_accertamento
 * @property string $created_at
 * @property string $targa
 * @property int|null $punti_patente
 * @property int $payed
 * @property string|null $data_pagamento
 * @property string|null $ricevuta_pagamento
 * @property string|null $id_cittadino
 * @property int|null $strumento
 * @property string|null $luogo
 */
class Contravvenzione extends \yii\db\ActiveRecord
{
    public $strumento_choices = [1 => "Agente in servizio", 2 => "Mediante telecamera"];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contravvenzione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'articolo_codice', 'data_accertamento', 'created_at', 'targa', 'orario_accertamento'], 'required'],
            [['amount'], 'number'],
            [['data_accertamento', 'created_at', 'data_pagamento', 'id_cittadino', 'strumento', 'luogo'], 'safe'],
            [['punti_patente', 'payed', 'id_cittadino', 'strumento'], 'integer'],
            [['articolo_codice', 'ricevuta_pagamento', 'orario_accertamento'], 'string', 'max' => 255],
            [['targa'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Numero',
            'amount' => 'Importo',
            'articolo_codice' => 'Articolo Codice',
            'data_accertamento' => 'Data Accertamento',
            'created_by' => "Aggiunta da",
            'updated_by' => "Modificata da",
            'created_at' => 'Creata il',
            'updated_at' => 'Modificata il',
            'targa' => 'Targa',
            'punti_patente' => 'Punti Patente',
            'payed' => 'Pagata',
            'data_pagamento' => 'Data Pagamento',
            'ricevuta_pagamento' => 'Ricevuta Pagamento',
            'id_cittadino' => "Cittadino",
            'orario_accertamento' => "Orario"
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at   = date("Y-m-d H:i:s");
            $this->created_by   = Yii::$app->user->identity->id;
            $this->payed        = 0;
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
        }

        // $this->data_accertamento = $this->data_accertamento;

        return true;
    }

    public function getStrumento(){
        return isset($this->strumento_choices[$this->strumento]) ? $this->strumento_choices[$this->strumento] : "-";
    }
}
