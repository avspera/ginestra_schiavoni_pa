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
 * @property string $created_at
 * @property string $targa
 * @property int|null $punti_patente
 * @property int $payed
 * @property string|null $data_pagamento
 * @property string|null $ricevuta_pagamento
 */
class Contravvenzione extends \yii\db\ActiveRecord
{
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
            [['amount', 'articolo_codice', 'data_accertamento', 'created_at', 'targa'], 'required'],
            [['amount'], 'number'],
            [['data_accertamento', 'created_at', 'data_pagamento'], 'safe'],
            [['punti_patente', 'payed'], 'integer'],
            [['articolo_codice', 'ricevuta_pagamento'], 'string', 'max' => 255],
            [['targa'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
        ];
    }

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)){
            return false;
        }

        if($this->isNewRecord){
            $this->created_at   = date("Y-m-d H:i:s");
            $this->created_by   = Yii::$app->user->identity->id;
            $this->payed        = 0;
        }else{
            $this->updated_at = date("Y-m-d H:i:s");
        }

        $this->data_accertamento = Utils::formatDateForDb($this->data_accertamento);

        return true;
    }
}
