<?php

namespace common\models;

require_once(__DIR__ . "/vendor/autoload.php");

use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {
   
    public $settings = [
        'sp_entityid' => SP_BASE_URL, // preferred: https protocol, no trailing slash, example: https://sp.example.com/
        'sp_key_file' => '/path/to/sp.key',
        'sp_cert_file' => '/path/to/sp.crt',
        'sp_comparison' => 'exact', // one of: "exact", "minimum", "better" or "maximum"
        'sp_assertionconsumerservice' => [
            // order is important ! the 0-base index in this array will be used as ID in the calls
            SP_BASE_URL . '/acs',
        ],
        'sp_singlelogoutservice' => [
            // order is important ! the 0-base index in this array will be used as ID in the calls
            [SP_BASE_URL . '/slo', 'POST'],
            [SP_BASE_URL . '/slo', 'REDIRECT']
        ],
        'sp_org_name' => 'your organization full name',
        'sp_org_display_name' => 'your organization display name',
        'sp_key_cert_values' => [ // Optional: remove this if you want to generate .key & .crt files manually
            'countryName' => 'Your Country',
            'stateOrProvinceName' => 'Your Province or State',
            'localityName' => 'Locality',
            'commonName' => 'Name',
            'emailAddress' => 'your@email.com',
        ],
        'idp_metadata_folder' => '/path/to/idp_metadata/',
        'sp_attributeconsumingservice' => [
            // order is important ! the 0-base index in this array will be used as ID in the calls
            ["fiscalNumber"],
            ["name", "familyName", "fiscalNumber", "email", "spidCode"],
        ],
        // Time in seconds of skew that is acceptable between client and server when checking OnBefore and NotOnOrAfter
        // assertion condition validity timestamps, and IssueInstant response / assertion timestamps. Optional.
        // Default is 0. Acceptable range: 0-300 (inclusive)
        'accepted_clock_skew_seconds' => 100
    ];
}

?>