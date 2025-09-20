<?php

use yii\helpers\Html;

$this->title = 'Подтверждение email';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow">
            <div class="card-body text-center p-5">
                <!-- Иконка email -->
                <div class="mb-4">
                    <i class="bi bi-envelope-check text-primary" style="font-size: 4rem;"></i>
                </div>

                <!-- Заголовок -->
                <h1 class="h3 mb-4 text-primary"><?= Html::encode($this->title) ?></h1>

                <!-- Основное сообщение -->
                <div class="alert alert-info border-0 mb-4" role="alert">
                    <h5 class="alert-heading mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        Регистрация почти завершена!
                    </h5>
                    <p class="mb-0">
                        Мы отправили письмо с подтверждением на указанный вами email-адрес.
                        Для завершения регистрации, пожалуйста, перейдите по ссылке в письме.
                    </p>
                </div>

                <!-- Инструкция -->
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Что делать дальше:</h6>
                    <ol class="list-unstyled text-start">
                        <li class="mb-2">
                            <i class="bi bi-1-circle text-primary me-2"></i>
                            Проверьте папку "Входящие" в вашей почте
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-2-circle text-primary me-2"></i>
                            Найдите письмо от нашей системы
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-3-circle text-primary me-2"></i>
                            Перейдите по ссылке подтверждения в письме
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-4-circle text-primary me-2"></i>
                            Вы будете автоматически авторизованы в системе
                        </li>
                    </ol>
                </div>

                <!-- Дополнительная информация -->
                <div class="alert alert-warning border-0 mb-4" role="alert">
                    <small>
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        <strong>Не получили письмо?</strong><br>
                        Проверьте папку "Спам" или "Нежелательная почта".
                        Письмо может прийти в течение нескольких минут.
                    </small>
                </div>

                <!-- Кнопки -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    <?= Html::a(
                        '<i class="bi bi-arrow-left me-1"></i> Вернуться к входу',
                        ['/site/login'],
                        ['class' => 'btn btn-outline-primary']
                    ) ?>
                    <?= Html::a(
                        '<i class="bi bi-house me-1"></i> На главную',
                        ['/site/index'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
}

.bi-envelope-check {
    opacity: 0.8;
}

.alert {
    border-radius: 10px;
}

ol li {
    display: flex;
    align-items: center;
}
</style>