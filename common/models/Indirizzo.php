<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "indirizzo".
 *
 * @property int $id
 * @property int|null $id_cittadino
 * @property int|null $id_atto_matrimonio
 * @property string $via
 * @property string|null $civico
 * @property int $cap
 * @property string $citta
 * @property string $provincia
 * @property int|null $type
 * @property int $created_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class Indirizzo extends \yii\db\ActiveRecord
{
    public $type_choices = [
      1 => "Residenza",
      2 => "Dimora abituale",
      3 => "Domicilio eletto",
      4 => "Residenza estera",
      5 => "«Presso» per località italiana",
      6 => "«Presso» per località estera",
      7 => "Ultima residenza italiana",
      8 => "Residenza temporanea",
      9 => "Altro",
      10 => "Resivisione onomastica stradale",
      11 => "Rettifica post accertamenti"
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'indirizzo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cittadino', 'id_atto_matrimonio', 'cap', 'type', 'created_by', 'updated_by'], 'integer'],
            [['via', 'cap', 'citta', 'provincia', 'created_at', 'created_by'], 'required'],
            [['updated_at', 'updated_by'], 'safe'],
            [['via', 'citta'], 'string', 'max' => 255],
            [['civico'], 'string', 'max' => 10],
            [['provincia'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cittadino' => 'Id Cittadino',
            'id_atto_matrimonio' => 'Id Atto Matrimonio',
            'via' => 'Via',
            'civico' => 'Civico',
            'cap' => 'Cap',
            'citta' => 'Citta',
            'provincia' => 'Provincia',
            'type' => 'Type',
            'created_at' => "Creato il",
            'updated_at' => "Modificato il",
            'created_by' => "Creato da",
            'updated_by' => "Modificato da"
        ];
    }

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)){
            return false;
        }

        if($this->isNewRecord){
            $this->created_at = date("Y-m-d H:i:s");
            $this->created_by = Yii::$app->user->identity->id;
        } else{
            $this->updated_by = Yii::$app->user->identity->id;
            $this->updated_at = date("Y-m-d H:i:s");
        }

        return true;
    }

    public function getType(){
        return isset($this->type_choices[$this->type]) ? $this->type_choices[$this->type] : "-";
    }
}
