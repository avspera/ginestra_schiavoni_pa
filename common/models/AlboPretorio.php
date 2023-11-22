<?php

namespace common\models;

use Yii;
use common\models\AttoDiMatrimonio;

/**
 * This is the model class for table "albo_pretorio".
 *
 * @property int $id
 * @property int $numero_atto
 * @property string $anno
 * @property int $id_tipologia
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
 * @property int|null $sorgente
 * @property int|null $id_atto_matrimonio
 */
class AlboPretorio extends \yii\db\ActiveRecord
{
    public $tipologia_matrimonio = 12;
    public $sorgente_matrimonio = 1;
    public $tipologia_choices = [
        1 => "Abusivismo Edilizio",
        2 => "Altri Enti",
        3 => "Avvisi",
        4 => "Bandi e Gare",
        5 => "Decreti",
        6 => "Deliberazione di Giunta",
        7 => "Deliberazione di Consiglio",
        8 => "Determine",
        9 => "Elettorale",
        10 => "Ordinanze",
        11 => "Permessi di Costruire",
        12 => "Pubblicazioni di Matrimonio",
        13 => "Pubblicazioni Ufficio Tecnico"
    ];

    public $sorgente_choices = [
        0 => "Interno",
        1 => "Atto di matrimonio"
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
            [['numero_atto', 'anno', 'id_tipologia', 'data_pubblicazione', 'created_at', 'created_by', 'titolo'], 'required'],
            [['numero_atto', 'id_tipologia', 'numero_affissione', 'created_by', 'updated_by', 'sorgente', "id_atto_matrimonio"], 'integer'],
            [['anno', 'data_pubblicazione', 'created_at', 'updated_at', 'data_fine_pubblicazione', 'sorgente', 'id_atto_matrimonio'], 'safe'],
            [['note', 'titolo', 'data_fine_pubblicazione'], 'string'],
            [['attachments'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, pdf', 'maxSize' => 1024 * 1024 * 2],
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
            'numero_affissione' => 'Numero Affissione',
            'data_pubblicazione' => 'Data Pubblicazione',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Aggiunto da',
            'updated_by' => 'Modificato da',
            'attachments' => 'Allegati',
            'note' => 'Note',
            'titolo' => "Titolo",
            'data_fine_pubblicazione' => "Data fine pubblicazione",
            'sorgente' => "Sorgente",
            'id_atto_matrimonio' => "Atto di matrimonio"
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

    public function getSorgente()
    {
        return isset($this->sorgente_choices[$this->sorgente]) ? $this->sorgente_choices[$this->sorgente] : "-";
    }

    public function getAttoDiMatrimonio()
    {
        $atto = AttoDiMatrimonio::findOne(["id" => $this->id_atto_matrimonio]);
        return $atto;
    }

    public function uploadFiles($attachments)
    {
        $path = Yii::getAlias('@frontend') . '/web/uploads/albo-pretorio/';

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
