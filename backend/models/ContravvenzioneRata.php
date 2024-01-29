<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contravvenzione_rata".
 *
 * @property int $id
 * @property int $id_contravvenzione
 * @property string $id_univoco_dovuto
 * @property string $id_univoco_versamento
 * @property string $causale
 * @property float $importo
 * @property int $stato
 * @property string $scadenza
 * @property string $created_at
 * @property string|null $updated_at
 */
class ContravvenzioneRata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contravvenzione_rata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'id_contravvenzione', 'created_at', 'id_univoco_dovuto',
                'id_univoco_versamento', 'causale', 'importo'
            ], 'required'],
            [['id_contravvenzione', 'stato'], 'integer'],
            [['importo'], 'number'],
            [['scadenza', 'updated_at'], 'safe'],
            [['id_univoco_dovuto', 'id_univoco_versamento', 'causale'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_contravvenzione' => 'Id Contravvenzione',
            'id_univoco_dovuto' => 'Id Univoco Dovuto',
            'id_univoco_versamento' => 'Id Univoco Versamento',
            'causale' => 'Causale',
            'importo' => 'Importo',
            'stato' => 'Stato',
            'scadenza' => 'Scadenza',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
        }

        return true;
    }
}
