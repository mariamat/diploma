<?php

return [
    'db' => [
        'class' => '\yii\db\Connection',
        'dsn' => 'mysql:host=' . $secrets['mySqlConnectionInfo']['host'] . ':' . $secrets['mySqlConnectionInfo']['port'] . ';dbname=' . $secrets['mySqlConnectionInfo']['database'],
        'username' => $secrets['mySqlConnectionInfo']['username'],
        'password' => $secrets['mySqlConnectionInfo']['password'],
        'charset' => 'utf8',
    ],
];