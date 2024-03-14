<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $nome
 * @property int $role
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $password_reset_token
 * @property string $created_at
 * @property string $last_login
 * @property string $picture
 * @property int $status
 */

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_DELETED    = 0;
    const STATUS_INACTIVE   = 9;
    const STATUS_ACTIVE     = 10;
    public $statusList      = [self::STATUS_INACTIVE => "Non attivo", self::STATUS_ACTIVE => "Attivo", self::STATUS_DELETED => "Cancellato"];
    public $roleList        = [0 => "Amministratore", 1 => "Certificati/Documenti", 2 => "Servizi Demografici", 3 => "Polizia Municipale", 4 => "Urbanistica"];
    public $roleListFlipped = ["amministratore" => 0, "certificati" => 1, "servizi_demografici" => 2, "polizia_municipale" => 3, "urbanistica" => 4];
    public $new_password            = "";
    public $new_password_confirm    = "";

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username', 'password', 'created_at', 'status', 'nome', 'email', 'role', 'created_by'], 'required'],
            [[
                'created_at', 'username', 'nome', 'last_login', 'updated_at',
                'new_password', 'new_password_confirm', 'picture', 'updated_by',
            ], 'safe'],
            [['username', 'email', 'picture'], 'string'],
            [['status', 'role', 'updated_by', 'created_by',], 'integer'],
            [['email'], 'email'],
            [['username'], 'unique'],
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
            'username' => 'Username',
            'email' => 'Email',
            'role' => 'Ruolo',
            'password' => 'Password',
            'status' => "Stato",
            'created_at' => 'Registrato il',
            'updated_at' => "Ultima modifica",
            'last_login' => "Ultimo accesso",
            'picture' => "Foto profilo"
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord) {
            $this->auth_key = \Yii::$app->security->generateRandomString();
            $this->created_at = date("Y-m-d H:i:s");
            // $this->created_by = Yii::$app->user->identity->id;
            $this->created_by = 1;
        } else {
            $this->updated_at = date("Y-m-d H:i:s");
        }
        return true;
    }

    public function isAdmin()
    {
        return $this->role === $this->roleListFlipped["amministratore"];
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {

        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function getStatus()
    {
        return isset($this->statusList[$this->status]) ? $this->statusList[$this->status] : "-";
    }

    public function getRole()
    {
        return isset($this->roleList[$this->role]) ? $this->roleList[$this->role] : "-";
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::find()->where(["username" => $username])->one();
    }


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function formatDate($value, $showHour = false)
    {
        $format = "d/m/Y";
        if ($showHour)
            $format = "d/m/Y H:i:s";

        return !empty($value) ? date($format, strtotime($value)) : "";
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
        return Yii::$app->getSecurity()->validatePassword($password, $hash);
    }

    public function getFakeUser()
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
