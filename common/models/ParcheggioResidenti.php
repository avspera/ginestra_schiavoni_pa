<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parcheggio_residenti".
 *
 * @property int $id
 * @property int $id_cittadino
 * @property int $id_indirizzo
 * @property int|null $qnt_auto
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property float|null $price
 * @property int $payed
 */
class ParcheggioResidenti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parcheggio_residenti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cittadino', 'id_indirizzo', 'created_at', 'created_by'], 'required'],
            [['id_cittadino', 'id_indirizzo', 'qnt_auto', 'created_by', 'updated_by', 'payed'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cittadino' => 'Cittadino',
            'id_indirizzo' => 'Indirizzo',
            'qnt_auto' => 'N. Auto',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Creato da',
            'updated_by' => 'Modificato da',
            'price' => 'Prezzo',
            'payed' => 'Pagato',
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
            $this->updated_at   = date("Y-m-d H:i:s");
            $this->updated_by   = Yii::$app->user->identity->id;
        }

        return true;
    }
}
