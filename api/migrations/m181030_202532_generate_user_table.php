<?php

use yii\db\Migration;

class m181030_202532_generate_user_table extends Migration {

    public function safeUp() {
        $this->createTable('user', [
            'id' => 'int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'username' => 'varchar(25) NOT NULL UNIQUE',
            'password' => 'varchar(250) NOT NULL',
            'aem' => 'int(8) DEFAULT NULL',
            'activated' => 'int(1) NOT NULL DEFAULT 0',
            'type' => 'int(1) NOT NULL DEFAULT 0',
            'last_name' => 'varchar(25) DEFAULT NULL',
            'first_name' => 'varchar(25) DEFAULT NULL',
            'act_code' => 'int(30) DEFAULT NULL',
            'email' => 'varchar(30) NOT NULL DEFAULT 0',
            'telephone' => 'bigint(10) DEFAULT NULL',
            'academicid' => 'bigint(12) DEFAULT NULL',
            'public_comment' => 'varchar(256) DEFAULT NULL',
            'private_comment' => 'varchar(256) DEFAULT NULL',
            'departmentid' => 'int(11) NOT NULL',
                ], 'ENGINE = InnoDB');
    }

    public function safeDown() {
        echo __CLASS__ . ' does not support migration down.' . PHP_EOL;
        return FALSE;
    }

}
