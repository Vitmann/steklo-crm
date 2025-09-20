<?php

/** @var yii\web\View $this */
/** @var string $confirmUrl */
/** @var app\models\User $user */

use yii\helpers\Html;

$this->title = 'Подтверждение регистрации';
?>

<div style="font-family: Arial, Helvetica, sans-serif; max-width: 100%; margin: 0 auto; padding: 20px; background-color: #f8f9fa;">
    <!-- Header -->
    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="color: #0d6efd; margin: 0; font-size: 28px; font-weight: 600;">
            <?= Yii::$app->params['siteName'] ?>
        </h1>
        <p style="color: #6c757d; margin: 5px 0 0 0; font-size: 14px;">
            Система управления клиентами
        </p>
    </div>

    <!-- Main Content -->
    <div style="background-color: #ffffff; border-radius: 12px; padding: 40px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <!-- Welcome Message -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="width: 80px; height: 80px; background-color: #e7f3ff; border-radius: 50%; margin: 0 auto 20px auto; display: flex; align-items: center; justify-content: center;">
                <span style="font-size: 32px; color: #0d6efd;">✉</span>
            </div>
            <h2 style="color: #212529; margin: 0 0 10px 0; font-size: 24px;">
                Добро пожаловать!
            </h2>
            <p style="color: #6c757d; margin: 0; font-size: 16px; line-height: 1.5;">
                Спасибо за регистрацию в нашей CRM-системе.<br>
                Осталось подтвердить ваш email-адрес.
            </p>
        </div>

        <!-- Action Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="<?= Html::encode($confirmUrl) ?>"
               style="display: inline-block; background-color: #0d6efd; color: #ffffff; text-decoration: none; padding: 16px 32px; border-radius: 8px; font-size: 16px; font-weight: 600; transition: background-color 0.3s;">
                Подтвердить email
            </a>
        </div>

        <!-- Additional Info -->
        <div style="background-color: #f8f9fa; border-radius: 8px; padding: 20px; margin: 25px 0;">
            <h4 style="color: #495057; margin: 0 0 15px 0; font-size: 16px;">
                Что произойдет после подтверждения:
            </h4>
            <ul style="color: #6c757d; margin: 0; padding-left: 20px; font-size: 14px; line-height: 1.6;">
                <li>Вы будете автоматически авторизованы в системе</li>
                <li>Получите доступ ко всем функциям CRM</li>
                <li>Сможете добавлять клиентов и создавать заказы</li>
            </ul>
        </div>

        <!-- Security Note -->
        <div style="border-left: 4px solid #ffc107; background-color: #fff9c4; padding: 15px 20px; margin: 20px 0;">
            <p style="color: #856404; margin: 0; font-size: 13px; line-height: 1.5;">
                <strong>Важно:</strong> Если вы не регистрировались в нашей системе, просто проигнорируйте это письмо.
                Ссылка будет действительна в течение 24 часов.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div style="text-align: center; margin-top: 30px; color: #adb5bd; font-size: 12px;">
        <p style="margin: 0;">
            Это автоматическое сообщение, отвечать на него не нужно.
        </p>
        <p style="margin: 5px 0 0 0;">
            © <?= date('Y') ?> <?= Yii::$app->params['siteName'] ?>
        </p>
    </div>
</div>