<?php

defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
defined('YII_ENV') or define('YII_ENV', 'prod'); // 'prod', 'dev', 'test'
defined('YII_ENV_PROD') or define('YII_ENV_PROD', TRUE);
defined('YII_ENV_DEV') or define('YII_ENV_DEV', FALSE);

// Production configuration
$productionConfig = [];
// Define specific configuration for app type
$appTypeConfig = [
    'web' => [],
    'console' => [],
];

return array_merge_recursive($appTypeConfig[$yiiAppType], $productionConfig);
