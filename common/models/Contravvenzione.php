<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contravvenzione".
 *
 * @property int $id
 * @property float $amount
 * @property string $articolo_codice
 * @property string $data_accertamento
 * @property string $created_at
 * @property string $targa
 * @property int|null $punti_patente
 * @property int $payed
 * @property string|null $data_pagamento
 * @property string|null $ricevuta_pagamento
 * @property int|null $updated_by
 * @property int $created_by
 * @property int|null $id_cittadino
 * @property string|null $orario_accertamento
 * @property string|null $luogo
 * @property int|null $strumento
 * @property string|null $nome
 * @property string|null $cognome
 * @property string|null $cf
 * @property string|null $via
 * @property string|null $civico
 * @property string|null $comune
 * @property string|null $cap
 * @property string|null $prov
 * @property string|null $nazione
 * @property string|null $email
 * @property int|null $rata
 * @property int|null $stato
 * @property string|null $id_univoco_versamento
 * @property string|null $tipo_persona
 * @property string|null $nome_flusso
 * @property string|null $id_flusso
 * @property string|null $scadenza
 * @property string|null $causale
 */
class Contravvenzione extends \yii\db\ActiveRecord
{

    public $strumento_choices = [1 => "Agente in servizio", 2 => "Mediante telecamera"];
    public $tipo_persona_choices = ["F" => "Persona Fisica", "G" => "Persona Giuridica"];
    public $stato_choices = [0 => "In attesa di pagamento", 1 => "Pagato", 2 => "Cancellato"];
    public $stato_choices_flipped = ['pending' => 0, 'payed' => 1, 'deleted' => 2];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contravvenzione';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'articolo_codice', 'data_accertamento', 'created_at', 'targa', 'created_by'], 'required'],
            [['amount'], 'number'],
            [['email'], 'email'],
            [['provincia'], 'string', 'max' => '2'],
            [[
                'data_accertamento', 'created_at', 'data_pagamento', 'orario_accertamento', 'causale',
                'tipo_persona', 'updated_at', 'nome_flusso', 'id_flusso', 'id_univoco_dovuto', 'scadenza', 'id_univoco_versamento'
            ], 'safe'],
            [['punti_patente', 'payed', 'updated_by', 'created_by', 'id_cittadino', 'strumento', 'rata', 'stato'], 'integer'],
            [[
                'articolo_codice', 'ricevuta_pagamento', 'nome', 'cognome', 'via', 'comune', 'nazione', 'email', 'id_univoco_versamento',
                'id_univoco_dovuto', 'causale',
            ], 'string', 'max' => 255],
            [['targa', 'civico', 'prov'], 'string', 'max' => 10],
            [['cf'], 'string', 'max' => 16],
            [['cap'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Importo',
            'articolo_codice' => 'Articolo Codice',
            'data_accertamento' => 'Data Accertamento',
            'created_at' => 'Aggiunta il',
            'updated_at' => "Modificata il",
            'created_by' => "Aggiunta da",
            'targa' => 'Targa',
            'punti_patente' => 'Punti Patente',
            'payed' => 'Pagato',
            'data_pagamento' => 'Data Pagamento',
            'ricevuta_pagamento' => 'Ricevuta Pagamento',
            'updated_by' => 'Modificata da',
            'id_cittadino' => 'Id Cittadino',
            'orario_accertamento' => 'Orario Accertamento',
            'luogo' => 'Luogo',
            'strumento' => 'Strumento',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'cf' => 'Cf',
            'via' => 'Via',
            'civico' => 'Civico',
            'comune' => 'Comune',
            'cap' => 'Cap',
            'prov' => 'Prov',
            'nazione' => 'Nazione',
            'email' => 'Email',
            'rata' => 'Rata',
            'id_univoco_versamento' => 'Id PagoPa',
            'stato' => "Stato",
            'nome_flusso' => 'Nome flusso PagoPa',
            'scadenza' => "Scadenza",
            'causale' => "Causale"
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
            $this->stato        = 0;
            $this->causale = "Contravvenzione N. " . $this->id . " del " . Yii::$app->formatter->asDate($this->data_accertamento) . " TARGA: " . $this->targa;
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
            $this->created_by   = Yii::$app->user->identity->id;
        }

        if ($this->cf) {
            $this->cf = strtoupper($this->cf);
        }

        return true;
    }

    public function getNextIdUnivocoDovuto()
    {
        $latestMulta = $this->find()->where(["=", "YEAR(data_accertamento)", date("Y")])->count("*");
        return $latestMulta == 0 ? 1 : strval($latestMulta + 1);
    }
    public function getStrumento()
    {
        return isset($this->strumento_choices[$this->strumento]) ? $this->strumento_choices[$this->strumento] : "-";
    }

    public function getTipoPersona()
    {
        return isset($this->tipo_persona_choices[$this->tipo_persona]) ? $this->tipo_persona_choices[$this->tipo_persona] : "-";
    }

    public function getStato()
    {
        return isset($this->stato_choices[$this->stato]) ? $this->stato_choices[$this->stato] : "-";
    }
}
