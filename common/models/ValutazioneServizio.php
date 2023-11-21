<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "valutazione_servizio".
 *
 * @property int $id
 * @property int $id_cittadino
 * @property string $nome_servizio
 * @property int $overall_rating
 * @property int|null $satisfaction_reason
 * @property int|null $angry_reason
 * @property string|null $notes
 */
class ValutazioneServizio extends \yii\db\ActiveRecord
{
    public $angry_reason_choices = [ 
        0 => "A volte le indicazioni non erano chiare",
        1 => "A volte le indicazioni non erano complete",
        2 => "A volte non capivo se stavo procedendo correttamente",
        3 => "Ho avuto problemi tecnici",
        4 => "Altro"
    ];

    public $satisfaction_reason_choices = [
        0 => "Le indicazioni erano chiare",
        1 => "Le indicazioni erano complete",
        2 => "Capivo sempre che stavo procedendo correttamente",
        3 => "Non ho avuto problemi tecnici",
        4 => "Altro"
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'valutazione_servizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cittadino', 'nome_servizio', 'overall_rating', 'created_at'], 'required'],
            [['id_cittadino', 'overall_rating', 'satisfaction_reason', 'angry_reason'], 'integer'],
            [['notes', 'created_at'], 'string'],
            [['nome_servizio'], 'string', 'max' => 20],
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
            'nome_servizio' => 'Nome Servizio',
            'overall_rating' => 'Voto',
            'satisfaction_reason' => 'Satisfaction Reason',
            'angry_reason' => 'Angry Reason',
            'notes' => 'Note',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->id_cittadino = Yii::$app->user->identity->id;
                $this->created_at = date("Y-m-d H:i:s");
            }
        }

        return true;
    }
}
