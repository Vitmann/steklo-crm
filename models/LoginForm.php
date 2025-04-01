<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Email',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            // Передаем rememberMe в метод login для управления длительностью сессии
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(['username' => $this->username]);
        }
        return $this->_user;
    }
}