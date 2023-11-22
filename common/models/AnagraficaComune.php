<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "anagrafica_comune".
 *
 * @property int $id
 * @property string $email
 * @property string|null $pec
 * @property string $centralino
 * @property string $via
 * @property int|null $civico
 * @property string $comune
 * @property string $provincia
 * @property string $responsabile_gestione_telematica
 */
class AnagraficaComune extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anagrafica_comune';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'centralino', 'via', 'comune', 'provincia', 'responsabile_gestione_telematica'], 'required'],
            [['civico'], 'integer'],
            [['email', 'pec', 'centralino', 'via', 'comune', 'provincia', 'responsabile_gestione_telematica'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'pec' => 'Pec',
            'centralino' => 'Centralino',
            'via' => 'Via',
            'civico' => 'Civico',
            'comune' => 'Comune',
            'provincia' => 'Provincia',
            'responsabile_gestione_telematica' => 'Responsabile Gestione Telematica',
        ];
    }
}
