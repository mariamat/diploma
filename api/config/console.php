<?php

$yiiAppType = 'console';
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
$vendorDirPath = ($basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);
require($vendorDirPath . 'autoload.php');
require($vendorDirPath . 'yiisoft' . DIRECTORY_SEPARATOR . 'yii2' . DIRECTORY_SEPARATOR . 'Yii.php');

$mainConfig = [
    'id' => 'diploma-api-console',
    'name' => 'diplomaApiConsole',
    'basePath' => $basePath,
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
//    'controllerMap' => [
//        'fixture' => [// Fixture generation command line.
//            'class' => 'yii\faker\FixtureController',
//        ],
//    ],
];

return array_merge_recursive(['components' => $dbConfig], $environmentConfig, $mainConfig);
