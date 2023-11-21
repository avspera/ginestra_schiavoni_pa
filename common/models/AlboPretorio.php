<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "albo_pretorio".
 *
 * @property int $id
 * @property int $numero_atto
 * @property string $anno
 * @property int $id_tipologia
 * @property int $id_settore
 * @property int|null $numero_affissione
 * @property string $data_pubblicazione
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property string|null $attachments
 * @property string|null $note
 * @property string $titolo
 * @property string|null $data_fine_pubblicazione
 */
class AlboPretorio extends \yii\db\ActiveRecord
{
    public $tipologia_choices = [
        0 => "Avviso",
        1 => "Convocazione di Consiglio",
        2 => "Deliberazione del Consiglio Comunale",
        3 => "Deliberazione della Giunta Comunale",
        4 => "Determinazione",
        5 => "Manifesto Elettorale",
        6 => "Ordinanze",
        7 => "Pubblicazioni di Matrimonio",
        8 => "Protocollo",
        9 => "Rilascio permessi di costruire"
    ];

    public $settore_choices = [
        0 => "STOCAZZO"
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'albo_pretorio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero_atto', 'anno', 'id_tipologia', 'id_settore', 'data_pubblicazione', 'created_at', 'created_by', 'titolo'], 'required'],
            [['numero_atto', 'id_tipologia', 'id_settore', 'numero_affissione', 'created_by', 'updated_by'], 'integer'],
            [['anno', 'data_pubblicazione', 'created_at', 'updated_at', 'data_fine_pubblicazione'], 'safe'],
            [['attachments', 'note', 'titolo', 'data_fine_pubblicazione'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero_atto' => 'Numero Atto',
            'anno' => 'Anno',
            'id_tipologia' => 'Tipologia',
            'id_settore' => 'Settore',
            'numero_affissione' => 'Numero Affissione',
            'data_pubblicazione' => 'Data Pubblicazione',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Aggiunto da',
            'updated_by' => 'Modificato da',
            'attachments' => 'Allegati',
            'note' => 'Note',
            'titolo' => "Titolo",
            'data_fine_pubblicazione' => "Data fine pubblicazione"
        ];
    }

    public function beforeSave($insert)
    {

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
            $this->created_by = Yii::$app->user->identity->id;
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
            $this->updated_by = Yii::$app->user->identity->id;
        }

        return parent::beforeSave($insert);
    }
    
    public function getTipologia()
    {
        return isset($this->tipologia_choices[$this->id_tipologia]) ? $this->tipologia_choices[$this->id_tipologia] : "-";
    }

    public function getSettore()
    {
        return isset($this->settore_choices[$this->id_settore]) ? $this->settore_choices[$this->id_settore] : "-";
    }
}
