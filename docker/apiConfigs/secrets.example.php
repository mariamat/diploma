<?php

return [
    'yiiDebugModule' => [
        'allowedIps' => ['x.x.x.x', 'y.y.y.y'],
    ],
    'yiiGiiModule' => [
        'allowedIps' => ['x.x.x.x', 'y.y.y.y'],
    ],
    'cookieValidationKey' => 'cookieValidationKey', // this needs to have a value
    'mySqlConnectionInfo' => [
        'host' => 'mysqldb',
        'port' => '3306',
        'database' => 'databaseName',
        'username' => 'username',
        'password' => 'password',
    ],
];
