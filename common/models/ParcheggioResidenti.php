<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parcheggio_residenti".
 *
 * @property int $id
 * @property int $id_cittadino
 * @property string $indirizzo
 * @property int|null $qnt_auto
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property float|null $price
 * @property int $payed
 * @property int|null $approved_by
 */
class ParcheggioResidenti extends \yii\db\ActiveRecord
{
    public $durata_choices = [1 => "3 mesi", 2 => "6 mesi", 3 => "1 anno"];

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
            [['id_cittadino', 'indirizzo', 'created_at', 'created_by', 'targa', 'approved', 'durata'], 'required'],
            [['id_cittadino', 'qnt_auto', 'created_by', 'updated_by', 'payed', 'durata', 'approved_by'], 'integer'],
            [['created_at', 'updated_at', 'veicolo', 'carta_circolazione', 'carta_identita', 'data_rilascio', 'approved_by'], 'safe'],
            [['price'], 'number'],
            [['carta_identita', 'carta_circolazione'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['veicolo', 'indirizzo'], 'string'],
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
            'indirizzo' => 'Indirizzo',
            'qnt_auto' => 'N. Auto',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Creato da',
            'updated_by' => 'Modificato da',
            'price' => 'Prezzo',
            'payed' => 'Pagato',
            'targa' => "Targa",
            'veicolo' => "Veicolo",
            'carta_identita' => "Carta di identità",
            'carta_circolazione' => "Carta di circolazione",
            'approved' => "Approvato",
            'data_rilascio' => "Data rilascio",
            'durata' => "Durata",
            'approved_by' => "Approvato da",
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
            $this->approved     = 0;
        } else {
            $this->updated_at   = date("Y-m-d H:i:s");
            $this->updated_by   = Yii::$app->user->identity->id;
        }

        return true;
    }

    public function uploadFiles($attachments)
    {
        $path = Yii::getAlias('@frontend') . '/web/uploads/parcheggio-residenti/';

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

        return NULL;
    }

    public function getDurata(){
        return isset($this->durata_choices[$this->durata]) ?  $this->durata_choices[$this->durata] : "-";
    }
}
