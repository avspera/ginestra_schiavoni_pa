<?php
return [
    'id' => 'ginestra-pa-manager',
    'language' => 'it',
    'name' => "Comune di Ginestra degli Schiavoni",
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'it',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
                // 'italia\bootstrapitalia\bootstrapitaliaAsset' => [
                //     'css' => [
                //         // Seleziona i file CSS necessari da Bootstrap Italia
                //         'bootstrap-italia/css/bootstrap-italia.min.css',
                //     ],
                // ],
            ],
        ],
        'formatter' => [
            'currencyCode' => "EUR"
        ]
    ],
];
