<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "veicolo".
 *
 * @property int $id
 * @property int $id_cittadino
 * @property string $targa
 * @property int $tipo_veicolo
 * @property string $allegato_1
 * @property string $allegato_2
 * @property string $modello
 * @property string $marca
 * @property int $tipo_relazione
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property Cittadino $cittadino
 */
class Veicolo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'veicolo';
    }

    public $tipo_veicolo_choices = [
        1 => 'Auto',
        2 => 'Moto',
        3 => 'Camion',
        4 => 'Furgone',
        5 => 'SUV',
        6 => 'Ciclomotore',
        7 => 'Minivan',
        8 => 'Autobus',
        9 => 'Veicolo commerciale',
        10 => 'Altro',
    ];

    public  $tipo_relazione_choices = [
        1 => 'Proprietario',
        2 => 'Utilizzatore',
        3 => 'Affittuario',
        4 => 'Comodatario',
        5 => 'A disposizione',
        6 => 'Altro',
    ];

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        return true;
    }

    public function getTipoVeicolo()
    {
        return isset($this->tipo_veicolo_choices[$this->tipo_veicolo]) ? $this->tipo_veicolo_choices[$this->tipo_veicolo] : "-";
    }

    public function getTipoRelazione()
    {
        return isset($this->tipo_relazione_choices[$this->tipo_relazione]) ? $this->tipo_relazione_choices[$this->tipo_relazione] : "-";
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cittadino', 'targa', 'tipo_veicolo', 'allegato_1', 'allegato_2', 'modello', 'marca', 'tipo_relazione', 'created_at'], 'required'],
            [['id_cittadino', 'tipo_veicolo', 'tipo_relazione'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['targa'], 'string', 'max' => 20],
            [['allegato_1', 'allegato_2'], 'string', 'max' => 255],
            [['modello', 'marca'], 'string', 'max' => 100],
            [['id_cittadino'], 'exist', 'skipOnError' => true, 'targetClass' => Cittadino::class, 'targetAttribute' => ['id_cittadino' => 'id']],
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
            'targa' => 'Targa',
            'tipo_veicolo' => 'Tipo Veicolo',
            'allegato_1' => 'Allegato 1',
            'allegato_2' => 'Allegato 2',
            'modello' => 'Modello',
            'marca' => 'Marca',
            'tipo_relazione' => 'Tipo Relazione',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Cittadino]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCittadino()
    {
        return $this->hasOne(Cittadino::class, ['id' => 'id_cittadino']);
    }
}
