<?php

namespace common\components;

use Yii;
use common\models\User;
use common\models\Cittadino;

class Utils
{

    public static function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    /**
     * returns user admin info (as model)
     * @param Integer $id
     * @return User $user
     */
    public static function getCreatedBy($id)
    {
        $user = User::findOne(["id" => $id]);
        return !empty($user) ? $user->nome : "-";
    }

    /**
     * returns user admin info (as model)
     * @param Integer $id
     * @return User $user
     */
    public static function getCittadino($id)
    {
        $cittadino = Cittadino::findOne(["id" => $id]);
        return !empty($cittadino) ? $cittadino->nome." ".$cittadino->cognome : "-";
    }

    /**
     * returns list as array of all admins for dropdown
     * @return Array $out
     */
    public static function getCreatedByList()
    {
        return yii\helpers\ArrayHelper::map(User::find()->orderBy('username')->all(), 'id', 'username');
    }

    /**
     * formats currency
     * @param double $amount
     * @return string
     */
    public static function formatCurrency($amount)
    {
        return \Yii::$app->formatter->asCurrency($amount, 'EUR', [
            \NumberFormatter::MIN_FRACTION_DIGITS => 2
        ]);
    }

    /**
     * formats time. shows only hours and minutes from given date string
     * @param String $value => date
     * @return String $time
     */
    public static function formatTime($value)
    {
        if (empty($value)) return NULL;

        $dt = new \DateTime($value);
        $time = $dt->format('H:i');
        return $time !== NULL ? $time : "-";
    }

    /**
     * formats date in european format dd/mm/yyyy (H:i:s). 
     * @param String $value => date
     * @param Boolean $showHours => default is false
     * @return String $date
     */
    public static function formatDate($value, $showHour = false)
    {
        $format = "d/m/Y";
        if ($showHour) {
            $format = "d/m/Y H:i:s";
        }

        return !empty($value) ? date($format, strtotime($value)) : "";
    }

    public static function formatTimeForDb($value)
    {
        isset($value) ? date('Y-m-d H:i:s', strtotime($value)) : NULL;
    }

    public static function formatDateForDb($value){
        $incoming = explode("-", $value);
        return $incoming[2]."-".$incoming[1]."-".$incoming[0];
    }
}
