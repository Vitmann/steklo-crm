<?php
use yii\db\Migration;

class m250914_000001_add_email_to_user extends Migration
{
    public function up()
    {
        // 1. Добавляем столбцы (email пока как NULL)
        $this->addColumn('user', 'email', $this->string(255)->null());
        $this->addColumn('user', 'email_confirm_token', $this->string(64)->null());
        $this->addColumn('user', 'is_confirmed', $this->boolean()->notNull()->defaultValue(false));

        // 2. Заполняем email уникальными значениями
        $users = (new \yii\db\Query())->from('user')->all();
        foreach ($users as $user) {
            $this->update('user', [
                'email' => 'user_' . $user['id'] . '@example.com'
            ], ['id' => $user['id']]);
        }

        // 3. Делаем email NOT NULL и добавляем UNIQUE
        $this->alterColumn('user', 'email', $this->string(255)->notNull());
        $this->createIndex('idx-user-email-unique', 'user', 'email', true);
    }

    public function down()
    {
        $this->dropIndex('idx-user-email-unique', 'user');
        $this->dropColumn('user', 'is_confirmed');
        $this->dropColumn('user', 'email_confirm_token');
        $this->dropColumn('user', 'email');
    }
}