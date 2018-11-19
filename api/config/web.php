<?php

$yiiAppType = 'web';
$basePath = __DIR__ . DIRECTORY_SEPARATOR . '..';
// First of all, load the secrets
$secrets = require('/run/secrets/diploma_api-secrets');
// Then load the localConfigs to extract local configurations
$localConfigs = require('/run/secrets/diploma_api-localConfigs');
$environmentConfig = require(__DIR__ . DIRECTORY_SEPARATOR . 'environments' . DIRECTORY_SEPARATOR . $localConfigs['environment'] . '.php');
// Then load the rest of the config files that may depend on secrets
$dbConfig = require(__DIR__ . DIRECTORY_SEPARATOR . 'dbConfig.php');
$params = require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php');
// Finally, load yii files
$vendorDirPath = $basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR;
require($vendorDirPath . 'autoload.php');
require($vendorDirPath . 'yiisoft' . DIRECTORY_SEPARATOR . 'yii2' . DIRECTORY_SEPARATOR . 'Yii.php');

$mainConfig = [
    'id' => 'diploma-api',
    'name' => 'diplomaApi',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation' => TRUE,
            'enableCsrfCookie' => TRUE,
            'cookieValidationKey' => $secrets['cookieValidationKey'],
            'enableCookieValidation' => TRUE,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
//            'useFileTransport' => true,
//        ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>/*' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
    ],
    'params' => $params,
];

return array_merge_recursive(['components' => $dbConfig], $environmentConfig, $mainConfig);
