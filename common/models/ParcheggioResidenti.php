<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parcheggio_residenti".
 *
 * @property int $id
 * @property int $id_cittadino
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int $stato_richiesta
 * @property int|null $updated_by
 * @property float|null $price
 * @property int $payed
 * @property int|null $approved_by
 */
class ParcheggioResidenti extends \yii\db\ActiveRecord
{
    public $durata_choices = [3 => "1 anno"];

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
            [['id_cittadino', 'created_at', 'created_by', 'approved', 'durata'], 'required'],
            [['created_by', 'updated_by', 'payed', 'durata', 'approved_by'], 'integer'],
            [[
                'created_at',
                'updated_at',
                'veicolo',
                'stato_richiesta',
                'data_rilascio',
                'approved_by',
                'numero_protocollo'
            ], 'safe'],
            [['price'], 'number'],
            [['veicolo', 'numero_protocollo'], 'string'],
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
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Creato da',
            'updated_by' => 'Modificato da',
            'price' => 'Prezzo',
            'payed' => 'Pagato',
            'veicolo' => "Veicolo",
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
            $this->payed        = 0;
            $this->approved     = 0;
        } else {
            $this->updated_at   = date("Y-m-d H:i:s");
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $logParams = [
            'LogRichieste' => [
                'id_model'      => $this->id,
                'model_type'    => "parcheggio-residenti",
                'prev_status'   => $insert ? NULL : ($changedAttributes['stato_richiesta'] ?? NULL),
                'new_status'    => $this->stato_richiesta,
                'action'        => $insert ? "create" : "update",
                'notes'         => "",
                'coming_from'   => "external",
            ]
        ];

        \common\components\Utils::writeLogs($logParams);
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

    public function getDurata()
    {
        return isset($this->durata_choices[$this->durata]) ?  $this->durata_choices[$this->durata] : "-";
    }

    public function getDurataChoices()
    {
        return $this->durata_choices;
    }
}
