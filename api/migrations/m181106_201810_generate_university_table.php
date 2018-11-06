<?php

use yii\db\Migration;

class m181106_201810_generate_university_table extends Migration {

    public function safeUp() {
        $this->createTable('university', [
            'id' => 'int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'shortname' => 'varchar(50) NOT NULL',
            'description' => 'varchar(100) NOT NULL',
                ], 'ENGINE = InnoDB');
    }

    public function safeDown() {
        echo __CLASS__ . ' does not support migration down.' . PHP_EOL;
        return FALSE;
    }

}
