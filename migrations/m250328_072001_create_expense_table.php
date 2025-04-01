<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%expense}}`.
 */
class m250328_072001_create_expense_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('expense', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'description' => $this->string(),
            'expense_date' => $this->date()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->addForeignKey('fk-expense-order_id', 'expense', 'order_id', 'order', 'id', 'CASCADE');
    }
    public function safeDown()
    {
        $this->dropTable('expense');
    }
}
