<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "atto_di_matrimonio".
 *
 * @property int $id
 * @property int|null $coniuge
 * @property string $data_matrimonio
 * @property string|null $data_richiesta
 * @property int $residenza
 * @property int $privacy
 * @property int $step
 * @property int|null $stato_richiesta
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $tipo_rito
 * @property string|null $luogo_matrimonio
 * @property int $regime_matrimoniale
 * @property int $approved,
 * @property int $published
 * @property int $id_cittadino
 * @property int $durata
 * @property int|null $published_by,
 * @property int|null $id_albo_pretorio
 */
class AttoDiMatrimonio extends \yii\db\ActiveRecord
{
    public $durata_choices = [1 => "15 giorni"];
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
        "B" => "Attestato_richiesta IFP di qualifica professionale triennale (operatore) / Diploma professionale quadriennale IFP di tecnico",
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
            [['id_cittadino', 'step', 'data_matrimonio', 'residenza', 'durata', 'created_at', 'regime_matrimoniale', 'privacy'], 'required'],
            [[
                'created_by',
                'updated_by',
                'tipo_rito',
                'regime_matrimoniale',
                'approved_by',
                'published_by',
                'id_albo_pretorio',
                'step',
                'stato_richiesta',
                'privacy',
                'coniuge',
                'durata'
            ], 'integer'],
            [[
                'created_at',
                'updated_at',
                'created_by',
                'stato_richiesta',
                'numero_protocollo',
                'data_richiesta',
                'numero_protocollo',
                'data_scadenza'
            ], 'safe'],
            [['data_matrimonio', 'residenza', 'numero_protocollo', 'numero_protocollo', 'data_scadenza'], 'string'],
            [['luogo_matrimonio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_matrimonio' => 'Data Matrimonio',
            'residenza' => 'Residenza',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
            'created_by' => 'Creato da',
            'updated_by' => 'Modificato da',
            'tipo_rito' => 'Tipo Rito',
            'luogo_matrimonio' => 'Luogo Matrimonio',
            'regime_matrimoniale' => 'Regime Matrimoniale',
            'approved' => "Approvato",
            'published' => "Pubblicato",
            'approved_by' => "Approvato da",
            'published_by' => "Pubblicato da",
            'id_albo_pretorio' => "Rif Albo Pretorio",
            'id_cittadino' => "Cittadino",
            'data_scadenza' => "Data scadenza"
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
            $this->created_by = isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : 0;
        }


        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $logParams = [
            'LogRichieste' => [
                'id_model'      => $this->id,
                'model_type'    => "atto-di-matrimonio",
                'prev_status'   => $insert ? NULL : ($changedAttributes['stato_richiesta'] ?? NULL),
                'new_status'    => $this->stato_richiesta,
                'action'        => $insert ? "create" : "update",
                'notes'         => "",
                'coming_from'   => "external",
            ]
        ];

        \common\components\Utils::writeLogs($logParams);
    }

    public function getDurata()
    {
        return isset($this->durata_choices[$this->durata]) ? $this->durata_choices[$this->durata] : "-";
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
