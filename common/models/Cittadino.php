<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cittadino".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $data_di_nascita
 * @property string $comune_di_nascita
 * @property string $documento_di_identita
 * @property int $tipo_documento
 * @property string $last_login
 * @property string $email
 * @property string|null $updated
 * @property string|null $professione
 * @property int|null $eta
 * @property string|null $comune_di_residenza
 * @property string|null $indirizzo_di_residenza
 * @property string|null $cittadinanza
 * @property int|null $stato_civile
 * @property string|null $codice_fiscale
 * @property string|null $telefono
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property string $spid_reference
 */
class Cittadino extends \yii\db\ActiveRecord
{

    public $tipo_documento_choices = [1 => "Carta di identità", 2 => "Patente di guida", 3 => "Passaporto"];
    public $stato_civile_choices = [
        1 => "Celibe/Nubile",
        2 => "Coniugato/a",
        3 => "Vedovo/a",
        4 => "Divorziato/a",
        9 => "Non classificabile/ignoto/n.c.",
        6 => "Unito civilmente",
        7 => "Stato libero a seguito di decesso della parte unita civilmente",
        8 => "Stato libero a seguito di scioglimento dell’unione"
    ];

    public $posizione_professionale_choices = [
        0 => "Non applicabile (es: condizione non professionale)",
        1 => "Dirigente",
        2 => "Quadro/impiegato",
        3 => "Operaio o assimilato",
        4 => "Imprenditore, libero professionista",
        5 => "Lavoratore in proprio",
        6 => "Coadiuvante familiare/socio coop.",
        7 => "Collaborazione coord-continuativa /Prestazione opera occasionale",
        9 => "Non conosciuta/non fornita",
        "A" => "Dirigente o impiegato (convenzione AIRE/ANPR)",
        "B" => "Lavoratore dipendente (convenzione AIRE/ANPR)",
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cittadino';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cognome', 'data_di_nascita', 'comune_di_nascita', 'documento_di_identita', 'tipo_documento', 'email', 'created_by', "created_at"], 'required'],
            [['documento_di_identita', 'last_login', 'updated_at', "updated_by", "spid_reference"], 'safe'],
            [['tipo_documento', 'eta', 'stato_civile'], 'integer'],
            [['nome', 'cognome', 'data_di_nascita', 'comune_di_nascita', 'email', 'professione', 'comune_di_residenza', 'indirizzo_di_residenza', 'last_login', 'spid_reference'], 'string', 'max' => 255],
            [['cittadinanza'], 'string', 'max' => 3],
            [['codice_fiscale'], 'string', 'max' => 16],
            [['telefono'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'data_di_nascita' => 'Data Di Nascita',
            'comune_di_nascita' => 'Comune Di Nascita',
            'documento_di_identita' => 'Documento Identita',
            'tipo_documento' => 'Tipo Documento',
            'last_login' => 'Last Login',
            'email' => 'Email',
            'updated' => 'Updated',
            'professione' => 'Professione',
            'eta' => 'Età',
            'comune_di_residenza' => 'Comune Di Residenza',
            'indirizzo_di_residenza' => 'Indirizzo Di Residenza',
            'cittadinanza' => 'Cittadinanza',
            'stato_civile' => 'Stato Civile',
            'codice_fiscale' => 'Codice Fiscale',
            'telefono' => 'Telefono',
            'created_at' => "Aggiunto il",
            'updated_at' => "Modificato il",
            'last_login' => "Ultimo accesso",
            'spid_reference' => "ID SPID"
        ];
    }

    public function beforeSave($insert)
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
            $this->created_by = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->id : "self";
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
            $this->updated_by = Yii::$app->user->identity->username;
        }

        return true;
    }

    public function getTipoDocumento()
    {
        return isset($this->tipo_documento_choices[$this->tipo_documento]) ? $this->tipo_documento_choices[$this->tipo_documento] : "";
    }

    public function getStatoCivile()
    {
        return isset($this->stato_civile_choices[$this->stato_civile]) ? $this->stato_civile_choices[$this->stato_civile] : "";
    }

    public static function getFakeCittadino()
    {
        return [
            "id" => "123456789",
            "name" => "Mario Rossi",
            "email" => "mario@example.com",
            "fiscal_code" => "RSSMRA80A01H501X",
            "attributes" => [
                "spid_level" => "1",
                "spid_mobile_phone" => "+393331234567",
                "spid_address" => "Via Roma 123",
                "spid_postal_code" => "00100",
                "spid_city" => "Roma",
                "spid_country" => "IT"
            ]
        ];
    }
}
