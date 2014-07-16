<?php

use yii\db\Schema;
use yii\db\Migration;

class m140716_084631_create_settings extends Migration
{
    protected $settingTable = '{{%settings}}';

    public function up()
    {
        $columns = [
            'id' => Schema::TYPE_PK,
            'created_at' => Schema::TYPE_TIMESTAMP ." DEFAULT CURRENT_TIMESTAMP",
            'updated_at' => Schema::TYPE_TIMESTAMP ." NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP",
            'is_active' => Schema::TYPE_BOOLEAN ." NOT NULL DEFAULT 0",
            'type' => Schema::TYPE_STRING,
            'category' => Schema::TYPE_STRING ." NOT NULL DEFAULT ''",
            'key' => Schema::TYPE_STRING ." NOT NULL DEFAULT ''",
            'value' => Schema::TYPE_TEXT
        ];
        $this->createTable($this->settingTable, $columns);
    }

    public function down()
    {
        $this->dropTable($this->settingTable);
    }
}
