<?php

namespace common\components;

use Yii;
use common\models\User;
use common\models\Cittadino;
use common\models\AlboPretorio;
use common\models\Indirizzo;
use common\models\LogRichieste;
use yii\base\Security;
use yii\db\Exception;
use yii\web\UploadedFile;

class Utils
{

    public static function generateRandomId($length = 10)
    {
        $security = new Security();
        return substr($security->generateRandomString($length), 0, $length);
    }

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
        return !empty($cittadino) ? $cittadino->nome . " " . $cittadino->cognome : "-";
    }

    public static function getResidenza($id)
    {
        $indirizzo = Indirizzo::findOne(["id" => $id]);
        return !empty($indirizzo) ? $indirizzo->via . ", " . $indirizzo->civico . " - " . $indirizzo->cap . " " . $indirizzo->provincia : "-";
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

    public static function formatDateForDb($value)
    {
        $incoming = explode("-", $value);
        return $incoming[2] . "-" . $incoming[1] . "-" . $incoming[0];
    }

    public static function getListaAnni()
    {
        $alboPretorio = AlboPretorio::find()->select(["anno"])->orderBy(["anno" => SORT_DESC])->distinct()->all();
        $out = [];
        foreach ($alboPretorio as $item) {
            $out[$item->anno] = $item->anno;
        }
        return $out;
    }

    public static function getStatoRichiesta($status)
    {
        $stato_richiesta_choices = [0 => "Da completare", 1 => 'In lavorazione', 2 => 'Approvata', 3 => 'Respinta', 4 => 'Completata', 5 => "Cancellata"];

        return isset($stato_richiesta_choices[$status]) ? $stato_richiesta_choices[$status] : "-";
    }

    public static function getStatoRichiestaList()
    {
        return [0 => "Da completare", 1 => 'In lavorazione', 2 => 'Approvata', 3 => 'Respinta', 4 => 'Completata', 5 => "Cancellata"];
    }

    public static function getStatoRichiestaFlipped($status)
    {
        $stato_richiesta_choices = ["da_completare" => 0, 'in_lavorazione' => 1, 'approvata' => 2, 'respinta' => 3, 'completata' => 4, "cancellata" => 5];

        return isset($stato_richiesta_choices[$status]) ? $stato_richiesta_choices[$status] : "-";
    }

    public static function getStatoRichiestaIcons($status)
    {
        $stato_richiesta_choices = [
            0 => ["class" => "warning", "image" => "folder-incomplete.svg"],
            1 => ["class" => "warning", "image" => "folder-incomplete.svg"],
            2 => ["class" => "success", "image" => "folder-concluded.svg"],
            3 => ["class" => "danger", "image" => "folder-incomplete.svg"],
            4 => ["class" => "success", "image" => "folder-concluded.svg"],
            4 => ["class" => "danger", "image" => "folder-incomplete.svg"],
        ];

        return isset($stato_richiesta_choices[$status]) ? $stato_richiesta_choices[$status] : "-";
    }

    public static function richiediNumeroProtocollo()
    {
        return self::generateRandomId();
    }

    public static function writeLogs($params)
    {

        $model = new LogRichieste();
        $model->load($params);

        try {
            $model->save(false);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function uploadFiles($model, $attribute, $path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $files = UploadedFile::getInstances($model, $attribute);

        $dbInsert = [];
        foreach ($files as $file) {
            $filename = time() . '-' . $file->baseName . '.' . $file->extension;
            if ($file->saveAs($path . $filename)) {
                $dbInsert[] = $filename;
            }
        }

        if (!empty($dbInsert)) {
            return implode(",", $dbInsert);
        }

        return false;
    }

    public static function printAttachments($model, $attribute)
    {
        if (!empty($model->$attribute)) {
            $attachments = explode(",", $model->$attribute);
            $html = "";
            $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/uploads/cittadino/' . $model->id_cittadino]);
            foreach ($attachments as $item) {
                $safeItem = yii\helpers\Html::encode($item);
                $fullUrl = $url . "/" . $safeItem;
                $html .= yii\helpers\Html::a("Vedi allegato", yii\helpers\Url::to($fullUrl), ["class" => "link"]) . "<br>";
            }
            return $html;
        }
        return "-";
    }

    public static function calcolaDataScadenza($inputDate, $addTime)
    {
        $newDate = new \DateTime($inputDate);
        $newDate->modify($addTime);
        return $newDate->format('Y-m-d H:i:s');
    }
}
