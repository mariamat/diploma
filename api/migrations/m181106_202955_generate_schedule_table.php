<?php

use yii\db\Migration;

class m181106_202955_generate_schedule_table extends Migration {

    public function safeUp() {
        $this->createTable('schedule', [
            'id' => 'int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'title' => 'varchar(50) DEFAULT NULL',
            'time_start' => 'time NOT NULL',
            'time_end' => 'time NOT NULL',
            'date_start' => 'date NOT NULL',
            'duration_minutes' => 'int(3) NOT NULL',
            'recurring' => 'int(1) NOT NULL DEFAULT 0',
                ], 'ENGINE = InnoDB');
    }

    public function safeDown() {
        echo __CLASS__ . ' does not support migration down.' . PHP_EOL;
        return FALSE;
    }

}
