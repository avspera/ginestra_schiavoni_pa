<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "atto_di_matrimonio".
 *
 * @property int $id
 * @property int $coniuge_uno
 * @property int $coniuge_due
 * @property string $data_matrimonio
 * @property int $residenza
 * @property int $step
 * @property int|null $stato
 * @property string|null $padre_coniuge_uno
 * @property string|null $madre_coniuge_uno
 * @property string|null $padre_coniuge_due
 * @property string|null $madre_coniuge_due
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $tipo_rito
 * @property string|null $luogo_matrimonio
 * @property int $regime_matrimoniale
 * @property int|null $titolo_studio_coniuge_uno
 * @property int|null $titolo_studio_coniuge_due
 * @property int|null $posizione_professionale_coniuge_uno
 * @property int|null $posizione_professionale_coniuge_due
 * @property int|null $condizione_non_professionale_coniuge_uno
 * @property int|null $condizione_non_professionale_coniuge_due
 * @property int $approved,
 * @property int $published
 * @property int $id_cittadino
 * @property int|null $published_by,
 * @property int|null $id_albo_pretorio
 */
class AttoDiMatrimonio extends \yii\db\ActiveRecord
{
    public $tipo_rito_choices = [1 => "Civile",  2 => "Religioso", 3 => "Entrambi"];
    public $regime_matrimoniale_choices = [1 => "Comunione dei beni",  2 => "Separazione dei beni"];
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
        "B" => "Attestato IFP di qualifica professionale triennale (operatore) / Diploma professionale quadriennale IFP di tecnico",
        "C" => "Diploma di maturità",
        "D" => "Certificato di specializzazione tecnica superiore (IFTS)",
        "E" => "Diploma di tecnico superiore (ITS)",
        "F" => "Laurea di primo livello (3 anni), Diploma universitario (2-3 anni), Diploma accademico di primo livello",
        "G" => "Laurea magistrale/specialistica o Diploma di laurea vecchio ordinamento (4-6 anni); Diploma accademico di secondo livello o Diploma accademico del vecchio ordinamento",
        "H" => "Dottorato",
        "Z" => "Non conosciuto/non fornito"
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

    public $condizione_non_professionale_choices = [
        0 => "Non applicabile (es: età pre-scolare)",
        1 => "Casalinga",
        2 => "Studente",
        3 => "Disoccupato/ in cerca di prima occupazione",
        4 => "Pensionato/ ritirato dal lavoro",
        5 => "Altra condizione non professionale",
        6 => "Non conosciuta / non fornita"
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'atto_di_matrimonio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cittadino', 'step', 'coniuge_uno', 'coniuge_due', 'data_matrimonio', 'residenza', 'created_at', 'regime_matrimoniale'], 'required'],
            [[
                'created_by',
                'updated_by',
                'tipo_rito',
                'regime_matrimoniale',
                'approved_by',
                'published_by',
                'id_albo_pretorio',
                'titolo_studio_coniuge_uno',
                'titolo_studio_coniuge_due',
                'posizione_professionale_coniuge_uno',
                'posizione_professionale_coniuge_due',
                'condizione_non_professionale_coniuge_uno',
                'condizione_non_professionale_coniuge_due',
                'step',
                'stato'
            ], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'stato', 'numero_protocollo', 'numero_protocollo'], 'safe'],
            [['data_matrimonio', 'coniuge_uno', 'coniuge_due', 'residenza', 'numero_protocollo', 'numero_protocollo'], 'string'],
            [['padre_coniuge_uno', 'madre_coniuge_uno', 'padre_coniuge_due', 'madre_coniuge_due', 'luogo_matrimonio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coniuge_uno' => 'Nome e Cognome',
            'coniuge_due' => 'Nome e Cognome',
            'data_matrimonio' => 'Data Matrimonio',
            'residenza' => 'Residenza',
            'padre_coniuge_uno' => 'Padre Coniuge uno',
            'madre_coniuge_uno' => 'Madre Coniuge uno',
            'padre_coniuge_due' => 'Padre Coniuge due',
            'madre_coniuge_due' => 'Madre Coniuge due',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Creato da',
            'updated_by' => 'Modificato da',
            'tipo_rito' => 'Tipo Rito',
            'luogo_matrimonio' => 'Luogo Matrimonio',
            'regime_matrimoniale' => 'Regime Matrimoniale',
            'titolo_studio_coniuge_uno' => 'Titolo Studio Coniuge uno',
            'titolo_studio_coniuge_due' => 'Titolo Studio Coniuge due',
            'posizione_professionale_coniuge_uno' => 'Posizione Professionale Coniuge uno',
            'posizione_professionale_coniuge_due' => 'Posizione Professionale Coniuge due',
            'condizione_non_professionale_coniuge_uno' => 'Condizione Non Professionale Coniuge uno',
            'condizione_non_professionale_coniuge_due' => 'Condizione Non Professionale Coniuge due',
            'approved' => "Approvato",
            'published' => "Pubblicato",
            'approved_by' => "Approvato da",
            'published_by' => "Pubblicato da",
            'id_albo_pretorio' => "Rif Albo Pretorio",
            'id_cittadino' => "Cittadino"
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
            $this->created_by = isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : 0;
            $this->published  = 0;
            $this->approved   = 0;
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
            $this->updated_by = Yii::$app->user->identity->id;
        }


        return true;
    }

    public function getTipoRito()
    {
        return isset($this->tipo_rito_choices[$this->tipo_rito]) ? $this->tipo_rito_choices[$this->tipo_rito] : "-";
    }

    public function getRegimeMatrimoniale()
    {
        return isset($this->regime_matrimoniale_choices[$this->regime_matrimoniale]) ? $this->regime_matrimoniale_choices[$this->regime_matrimoniale] : "";
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
