<?php

use yii\db\Migration;

class m250913_000002_add_company_and_assign_to_users extends Migration
{
    public function up()
    {
        // 1. Вставить первую компанию
        $time = time();
        $this->insert('company', [
            'name' => 'Default Company',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $companyId = $this->db->getLastInsertID();

        // 2. Добавить поле company_id в user (разрешить NULL на время миграции)
        $this->addColumn('user', 'company_id', $this->integer()->null());

        // 3. Проставить company_id всем существующим пользователям
        $this->update('user', ['company_id' => $companyId]);

        // 4. Сделать поле company_id обязательным
        $this->alterColumn('user', 'company_id', $this->integer()->notNull());

    }

    public function down()
    {
        $this->dropForeignKey('fk_user_company', 'user');
        $this->dropColumn('user', 'company_id');
        // Таблицу company не трогаем, она создаётся отдельной миграцией
    }
}
