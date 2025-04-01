<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m250328_071231_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'start_date' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }
    public function safeDown()
    {
        $this->dropTable('order');
    }
}
