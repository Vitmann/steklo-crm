<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m250401_073847_create_contacts_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('contacts', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'post' => $this->string(255),
            'phone' => $this->string(50),
            'comment' => $this->text(),
        ]);

        // Добавляем внешний ключ для связи с таблицей client
        $this->addForeignKey(
            'fk-contacts-client_id',
            'contacts',
            'client_id',
            'client',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-contacts-client_id', 'contacts');
        $this->dropTable('contacts');
    }
}
