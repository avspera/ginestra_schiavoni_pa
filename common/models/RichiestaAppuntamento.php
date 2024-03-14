<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "richiesta_appuntamento".
 *
 * @property int $id
 * @property string $email_richiedente
 * @property string $nome_richiedente
 * @property string $cf_richiedente
 * @property string $data
 * @property int $sede_riferimento
 * @property string|null $note
 * @property string|null $attachments
 */
class RichiestaAppuntamento extends \yii\db\ActiveRecord
{
    public $sede_riferimento_choices = [1 => "Albo pretorio", 2 => "Atti di matrimonio", 3 => "Contravvenzioni", 4 => "Parcheggio residenti"];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'richiesta_appuntamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_richiedente', 'nome_richiedente', 'data', 'sede_riferimento'], 'required'],
            [['data'], 'safe'],
            [['sede_riferimento'], 'integer'],
            [['note'], 'string'],
            [['email_richiedente', 'nome_richiedente', 'attachments'], 'string', 'max' => 255],
            [['cf_richiedente'], 'string', 'max' => 16],
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
            'cf_richiedente' => 'Codice fiscale',
            'data' => 'Data',
            'sede_riferimento' => 'Ufficio di Riferimento',
            'note' => 'Note',
            'attachments' => 'Allegati',
        ];
    }

    public function getSedeRiferimento()
    {
        return isset($this->sede_riferimento_choices[$this->sede_riferimento]) ? $this->sede_riferimento_choices[$this->sede_riferimento] : "-";
    }

    public function uploadFiles($attachments)
    {
        $path = Yii::getAlias('@frontend') . '/web/uploads/richiesta-appuntamento/';

        $dbInsert = [];
        foreach ($attachments as $value) {
            $filename = time() . '-' . $value->baseName . '.' . $value->extension;
            if ($value->saveAs($path . $filename)) {
                $dbInsert[] = $filename;
            }
        }

        if (!empty($dbInsert)) {
            return json_encode($dbInsert);
        }

        return false;
    }
}
