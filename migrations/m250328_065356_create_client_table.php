<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m250328_065356_create_client_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'name' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_at' => $this->integer()->notNull(),
        ]);
    }
    public function safeDown()
    {
        $this->dropTable('client');
    }
}
