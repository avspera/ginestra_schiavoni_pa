<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "richieste_tmp".
 *
 * @property int $id
 * @property int $external_id
 * @property string $tipo_richiesta
 * @property int $id_cittadino
 * @property int $step
 * @property string|null $data
 * @property string $created_at
 * @property string $updated_at
 */
class RichiesteTmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'richieste_tmp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['external_id', 'tipo_richiesta', 'id_cittadino', 'step'], 'required'],
            [['external_id', 'id_cittadino', 'step'], 'integer'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['tipo_richiesta'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'external_id' => 'External ID',
            'tipo_richiesta' => 'Tipo Richiesta',
            'id_cittadino' => 'Id Cittadino',
            'step' => 'Step',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
