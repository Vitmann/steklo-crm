<?php
namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $company_name;
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['company_name', 'username', 'email', 'password', 'password_repeat'], 'required'],
            [['company_name', 'username', 'email'], 'string', 'max' => 255],
            [['company_name'], 'unique', 'targetClass' => Company::class, 'targetAttribute' => 'name', 'message' => 'Компания с таким названием уже существует.'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email', 'message' => 'Пользователь с таким email уже существует.'],
            [['email'], 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают.'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'company_name' => 'Название компании',
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }
}
