<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assistenza_reply".
 *
 * @property int $id
 * @property int $id_assistenza
 * @property string $messaggio
 * @property int|null $created_by
 * @property string $created_at
 */
class AssistenzaReply extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assistenza_reply';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_assistenza', 'messaggio', 'created_at'], 'required'],
            [['id_assistenza', 'created_by'], 'integer'],
            [['messaggio'], 'string'],
            [['created_at', 'created_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_assistenza' => 'Id Assistenza',
            'messaggio' => 'Messaggio',
            'created_by' => 'Utente',
            'created_at' => 'Data risposta',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
            $this->created_by = isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : NULL;
        }
        return true;
    }
}