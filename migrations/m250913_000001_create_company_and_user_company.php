<?php

use yii\db\Migration;

class m250913_000001_create_company_and_user_company extends Migration
{
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_company', 'user');
        $this->dropColumn('user', 'company_id');
        $this->dropTable('company');
    }
}

