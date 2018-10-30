<?php

use yii\db\Migration;

class m181030_202532_generate_user_table extends Migration {

    public function safeUp() {
        $this->createTable('user', [
            'id' => 'int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'name' => 'varchar(255) NOT NULL',
            'formatted_address' => 'varchar(255) NOT NULL',
            // ------ standard fields --------------------------------------
            'creation_datetime' => 'datetime NOT NULL',
            'modification_datetime' => 'datetime NOT NULL',
            'deleted' => 'tinyint UNSIGNED NOT NULL DEFAULT 0',
            'deleted_datetime' => 'datetime NULL DEFAULT NULL',
                ], 'ENGINE = InnoDB');
    }

    public function safeDown() {
        echo __CLASS__ . ' does not support migration down.' . PHP_EOL;
        return FALSE;
    }

}
