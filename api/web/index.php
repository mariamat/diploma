<?php

// Load the configuration file which contains the current configuration and load the yii related files
$config = require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'web.php';

(new yii\web\Application($config))->run();