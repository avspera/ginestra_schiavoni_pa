<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "log_richieste".
 *
 * @property int $id
 * @property int $id_model
 * @property int $model_type
 * @property int $prev_status
 * @property int $new_status
 * @property string $action
 * @property string|null $notes
 * @property string $created_at
 * @property string $coming_from
 */
class LogRichieste extends \yii\db\ActiveRecord
{
    public $model_type_choices = [
        'accesso-agli-atti'     => "Accesso agli atti",
        'contravvenzioni'       => "Contravvenzione",
        'atto-di-matrimonio'    => "Atto di matrimonio",
        'parcheggio-residenti'  => "Parcheggio residenti"
    ];

    public $model_type_choices_flipped = [
        "accesso-agli-atti" => 1,
        "contravvenzioni" => 2,
        "atto-di-matrimonio" => 3,
        "parcheggio-residenti" => 4
    ];

    public function getModelType()
    {
        return isset($this->model_type_choices[$this->model_type]) ? $this->model_type_choices[$this->model_type] : "-";
    }

    public function beforeSave($insert)
    {
        $this->created_at = date("Y-m-d H:i:s");
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log_richieste';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_model', 'model_type', 'prev_status', 'new_status', 'action', 'created_at', 'coming_from'], 'required'],
            [['id_model', 'prev_status', 'new_status'], 'integer'],
            [['notes'], 'string'],
            [['created_at'], 'safe'],
            [['action'], 'string', 'max' => 20],
            [['coming_from', 'model_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_model' => 'Id Model',
            'model_type' => 'Model Type',
            'prev_status' => 'Prev Status',
            'new_status' => 'New Status',
            'action' => 'Action',
            'notes' => 'Notes',
            'created_at' => 'Created At',
            'coming_from' => 'Coming From',
        ];
    }
}
