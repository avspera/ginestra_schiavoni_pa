<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assistenza".
 *
 * @property int $id
 * @property string $email_richiedente
 * @property string $nome_richiedente
 * @property string $cognome_richiedente
 * @property int $motivo_richiesta
 * @property string|null $data_appuntamento
 * @property int $stato_richiesta
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $note
 */
class Assistenza extends \yii\db\ActiveRecord
{
    public $stato_richiesta_flipped = ["pending" => 1, "accepted" => 2, "rejected" => 3];
    public $stato_richiesta_choices = [1 => "In attesa", 2 => "Accettato", 3 => "Rifiutato"];
    public $motivo_richiesta_choices = [1 => "Albo pretorio", 2 => "Pubblicazioni di Matrimonio", 3 => "Contravvenzioni", 4 => "Parcheggio Residenti"];
    public $motivo_richiesta_flipped = ["albo_pretorio" => 1, "pubblicazioni_matrimonio" => 2, "contravvenzioni" => 3, "parcheggio_residenti" => 4];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assistenza';
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
            $this->stato_richiesta = $this->stato_richiesta_flipped["pending"];
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
            $this->updated_by = Yii::$app->user->identity->id;
        }

        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_richiedente', 'nome_richiedente', 'cognome_richiedente', 'motivo_richiesta', 'stato_richiesta', 'created_at'], 'required'],
            [['motivo_richiesta', 'stato_richiesta', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'data_appuntamento'], 'safe'],
            [['note', 'data_appuntamento'], 'string'],
            [['email_richiedente', 'nome_richiedente', 'cognome_richiedente'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email_richiedente' => 'Email Richiedente',
            'nome_richiedente' => 'Nome Richiedente',
            'cognome_richiedente' => 'Cognome Richiedente',
            'motivo_richiesta' => 'Motivo Richiesta',
            'data_appuntamento' => 'Data',
            'stato_richiesta' => 'Stato Richiesta',
            'created_at' => 'Data creazione',
            'updated_at' => 'Data aggiornamento',
            'updated_by' => 'Aggiornato da',
            'note' => 'Note',
        ];
    }

    public function getStatoRichiesta()
    {
        return isset($this->stato_richiesta_choices[$this->stato_richiesta]) ? $this->stato_richiesta_choices[$this->stato_richiesta] : "-";
    }

    public function getMotivoRichiesta()
    {
        return isset($this->motivo_richiesta_choices[$this->motivo_richiesta]) ? $this->motivo_richiesta_choices[$this->motivo_richiesta] : "-";
    }
}
