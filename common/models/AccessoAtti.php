<?php

namespace common\models;

use Yii;
use common\components\Utils;

/**
 * This is the model class for table "accesso_atti".
 *
 * @property int $id
 * @property string|null $numero_protocollo
 * @property int $id_cittadino
 * @property int $type
 * @property int $privacy
 * @property double $payment
 * @property int $payed
 * @property string $oggetto_richiesta
 * @property string|null $messaggio_richiesta
 * @property string $data_richiesta
 * @property string|null $stato_richiesta
 * @property string|null $data_risposta
 * @property string|null $note
 * @property string|null $documento_rilasciato
 * @property string|null $data_creazione
 * @property string|null $data_aggiornamento
 *
 * @property Cittadino $cittadino
 */
class AccessoAtti extends \yii\db\ActiveRecord
{

    public $stato_richiesta_choices = [1 => 'In lavorazione', 2 => 'Approvata', 3 => 'Respinta', 4 => 'Completata'];
    public $stato_richiesta_choices_flipped = ['in_lavorazione' => 1, 'approvata' => 2, 'Respinta' => 3, 'Completata' => 4];
    public $type_choices = [1 => "Standard", 2 => "Diritti di urgenza"];
    public $type_choices_flipped = ["standard" => 1, "urgenza" => 2];
    public $payment_choices_flipped = ["standard" => 0, "urgenza" => 150];

    public function getType()
    {
        return isset($this->type_choices[$this->type]) ? $this->type_choices[$this->type] : "-";
    }
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->data_creazione       = date("Y-m-d H:i:s");
            $this->stato_richiesta      = Utils::getStatoRichiestaFlipped("da_completare");
            $logParams["LogRichieste"] = [
                'id_model'      => $this->id,
                'model_type'    => "accesso-agli-atti",
                'prev_status'   => NULL,
                'new_status'    => $this->stato_richiesta,
                'action'        => "create",
                'notes'         => $this->note,
                'coming_from'   => "external"
            ];

            Utils::writeLogs($logParams);
        } else {
            $this->data_aggiornamento   = date("Y-m-d H:i:s");
            $this->privacy              = 1;
        }

        if ($this->step == 4) {
            $this->stato_richiesta == $this->stato_richiesta_choices_flipped["in_lavorazione"];
            $this->numero_protocollo    = Utils::richiediNumeroProtocollo();
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accesso_atti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cittadino', 'oggetto_richiesta', 'data_richiesta', 'type', 'step', 'privacy'], 'required'],
            [['id_cittadino', 'step', 'privacy'], 'integer'],
            [['oggetto_richiesta', 'stato_richiesta', 'note', 'id'], 'string'],
            [[
                'data_richiesta',
                'data_risposta',
                'data_creazione',
                'payment',
                'payed',
                'data_aggiornamento',
                'messaggio_richiesta'
            ], 'safe'],
            [['numero_protocollo'], 'string', 'max' => 50],
            [['documento_rilasciato'], 'string', 'max' => 255],
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
            'numero_protocollo' => 'Numero Protocollo',
            'id_cittadino' => 'Id Cittadino',
            'oggetto_richiesta' => 'Oggetto Richiesta',
            'data_richiesta' => 'Data Richiesta',
            'stato_richiesta' => 'Stato Richiesta',
            'data_risposta' => 'Data Risposta',
            'note' => 'Note',
            'documento_rilasciato' => 'Documento Rilasciato',
            'data_creazione' => 'Data Creazione',
            'data_aggiornamento' => 'Data Aggiornamento',
            'messaggio_richiesta' => "Messaggio",
            'pagamento' => "Pagamento",
            'payed' => "Pagato",
            'type' => "Tipo richiesta",
            'step' => "Step"
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
