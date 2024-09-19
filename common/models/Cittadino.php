<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cittadino".
 *
 * @property int $id
 * @property string $fullname
 * @property string $nome
 * @property string $cognome
 * @property string $data_di_nascita
 * @property string $luogo_di_nascita
 * @property string $documento_di_identita
 * @property int $tipo_documento
 * @property string $last_login
 * @property string $email
 * @property string|null $updated
 * @property string|null $professione
 * @property string|null $patente_di_guida
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
 * @property string|null $sesso
 * @property int|null $titolo_studio
 * @property int|null $condizione_non_professionale
 * @property int|null $posizione_professionale
 */
class Cittadino extends \yii\db\ActiveRecord
{

    public $condizione_non_professionale_choices = [
        0 => "Non applicabile (es: età pre-scolare)",
        1 => "Casalinga",
        2 => "Studente",
        3 => "Disoccupato/ in cerca di prima occupazione",
        4 => "Pensionato/ ritirato dal lavoro",
        5 => "Altra condizione non professionale",
        6 => "Non conosciuta / non fornita"
    ];

    public $titolo_studio_choices = [
        0 => "Non applicabile",
        1 => "Nessun titolo/licenza elementare",
        2 => "Licenza media",
        3 => "Diploma scuola superiore",
        4 => "Laurea Triennale",
        5 => "Laurea",
        6 => "Dottorato/specializz. Post-laurea",
        7 => "Nessun titolo",
        8 => "Licenza elementare",
        "A" => "Diploma di qualifica professionale e qualifiche regionali di 2-3 anni",
        "B" => "Attestato_richiesta IFP di qualifica professionale triennale (operatore) / Diploma professionale quadriennale IFP di tecnico",
        "C" => "Diploma di maturità",
        "D" => "Certificato di specializzazione tecnica superiore (IFTS)",
        "E" => "Diploma di tecnico superiore (ITS)",
        "F" => "Laurea di primo livello (3 anni), Diploma universitario (2-3 anni), Diploma accademico di primo livello",
        "G" => "Laurea magistrale/specialistica o Diploma di laurea vecchio ordinamento (4-6 anni); Diploma accademico di secondo livello o Diploma accademico del vecchio ordinamento",
        "H" => "Dottorato",
        "Z" => "Non conosciuto/non fornito"
    ];

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
            [['fullname', 'nome', 'cognome', 'data_di_nascita', 'luogo_di_nascita', 'documento_di_identita', 'tipo_documento', 'email', 'created_by', "created_at"], 'required'],
            [['documento_di_identita', 'last_login', 'updated_at', "updated_by", "spid_reference", "sesso", 'titolo_studio'], 'safe'],
            [['tipo_documento', 'eta', 'stato_civile'], 'integer'],
            [['nome', 'cognome', 'data_di_nascita', 'luogo_di_nascita', 'email', 'posizione_professionale', 'condizione_non_professionale', 'titolo_di_studio', 'comune_di_residenza', 'indirizzo_di_residenza', 'last_login', 'spid_reference', 'fullname'], 'string', 'max' => 255],
            [['cittadinanza'], 'string', 'max' => 3],
            [['codice_fiscale'], 'string', 'max' => 16],
            [['telefono'], 'string', 'max' => 20],
            [['patente_di_guida'], 'file', 'skipOnEmpty' => true, 'accept' => ['pdf', 'jpg', 'png']],
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
            'luogo_di_nascita' => 'Comune Di Nascita',
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
            'spid_reference' => "ID SPID",
            'patente_di_guida' => 'Patente di guida'
        ];
    }

    public function beforeSave($insert)
    {

        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at   = date("Y-m-d H:i:s");
            $this->created_by   = isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->id : "self";
            $this->fullname     = $this->nome . " " . $this->cognome;
            $this->codice_fiscale = strtolower($this->codice_fiscale);
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
            "id" => 1,
            'fullname' => "Giulia Rossi",
            'name' => "Giulia",
            "surname" => "Rossi",
            'codice_fiscale' => 'GLABNC72H25H501Y',
            'indirizzo' => 'Via Roma 16, 00100 Roma, It',
            'domicilio' => "Piazza Risorgimento 16, 00100 Roma, It",
            'data_di_nascita' => '1987-01-18',
            'luogo_di_nascita' => "Salerno",
            'sesso' => "Donna",
            'telefono' => "+39 331 1234567",
            'email' => "prova@prova.it"
        ];
    }

    public function getTitoloStudio($label)
    {
        return isset($this->titolo_studio_choices[$label]) ? $this->titolo_studio_choices[$label] : "-";
    }

    public function getPosizioneProfessionale($label)
    {
        return isset($this->posizione_professionale_choices[$label]) ? $this->posizione_professionale_choices[$label] : "-";
    }

    public function getCondizioneNonProfessionale($label)
    {
        return isset($this->condizione_non_professionale_choices[$label]) ? $this->condizione_non_professionale_choices[$label] : "-";
    }
}
