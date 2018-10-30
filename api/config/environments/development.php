<?php

defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
defined('YII_ENV') or define('YII_ENV', 'dev'); // 'prod', 'dev', 'test'
defined('YII_ENV_PROD') or define('YII_ENV_PROD', FALSE);
defined('YII_ENV_DEV') or define('YII_ENV_DEV', TRUE);

// Development configuration
$developmentConfig = [];
// Define specific configuration for app type
$appTypeConfig = [
    'web' => [
        'bootstrap' => [
            'debug',
            'gii',
        ],
        'modules' => [
            'debug' => [
                'class' => 'yii\debug\Module',
                // uncomment the following to add your IP if you are not connecting from localhost.
                'allowedIPs' => $secrets['yiiDebugModule']['allowedIps'],
            ],
            'gii' => [
                'class' => 'yii\gii\Module',
                // uncomment the following to add your IP if you are not connecting from localhost.
                'allowedIPs' => $secrets['yiiGiiModule']['allowedIps'],
            ],
        ],
    ],
    'console' => [],
];

return array_merge_recursive($appTypeConfig[$yiiAppType], $developmentConfig);
