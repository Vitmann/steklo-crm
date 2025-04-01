<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment}}`.
 */
class m250328_071823_create_payment_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('payment', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'payment_date' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('fk-payment-order_id', 'payment', 'order_id', 'order', 'id', 'CASCADE');
    }
    public function safeDown()
    {
        $this->dropTable('payment');
    }
}
