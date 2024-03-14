<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "segnalazione_disservizio".
 *
 * @property int $id
 * @property int $id_tipologia
 * @property int $luogo
 * @property string $note
 * @property string|null $attachments
 * @property string $created_at
 * @property string $nome_richiedente
 * @property string $cf_richiedente
 * @property string $email_richiedente
 */
class SegnalazioneDisservizio extends \yii\db\ActiveRecord
{
    public $tipologia_choices = [1 => "Contenuto non raggiungibile", 2 => "Contenuto non presente", 3 => "Procedura non completata correttamente"];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'segnalazione_disservizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipologia', 'note', 'created_at', 'nome_richiedente', 'cf_richiedente', 'email_richiedente'], 'required'],
            [['id_tipologia', 'luogo'], 'integer'],
            [['note', 'attachments'], 'string'],
            [['luogo'], 'safe'],
            [['nome_richiedente', 'email_richiedente'], 'string', 'max' => 255],
            [['cf_richiedente',], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tipologia' => 'Tipologia',
            'luogo' => 'Luogo',
            'note' => 'Note',
            'attachments' => 'Allegati',
            'created_at' => 'Creato il',
            'nome_richiedente' => 'Nome Richiedente',
            'cf_richiedente' => 'Codice fiscale',
            'email_richiedente' => 'Email Richiedente',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
        }

        return true;
    }
    public function getTipologia()
    {
        return isset($this->tipologia_choices[$this->id_tipologia]) ? $this->tipologia_choices[$this->id_tipologia] : "-";
    }
}
