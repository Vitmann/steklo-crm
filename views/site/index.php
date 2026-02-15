<?php

/** @var yii\web\View $this */

$this->title = Yii::$app->params['siteName'];
?>

<?php if (Yii::$app->user->isGuest): ?>
    <div class="site-index">
        <!-- Hero Section -->
        <div class="hero-section bg-primary text-white py-5 mb-5 rounded-3">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-4">
                            <i class="bi bi-people-fill me-3"></i>
                            Добро пожаловать в CRM
                        </h1>
                        <p class="lead fs-4 mb-4">
                            Простая и эффективная система управления клиентами для вашего бизнеса
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="/site/register" class="btn btn-light btn-lg px-4 me-md-2">
                                <i class="bi bi-person-plus me-2"></i>Начать работу
                            </a>
                            <a href="/site/login" class="btn btn-outline-light btn-lg px-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Войти
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-primary bg-gradient text-white rounded-3 d-inline-flex align-items-center justify-content-center fs-2 mb-3" style="width: 4rem; height: 4rem;">
                                <i class="bi bi-people"></i>
                            </div>
                            <h3 class="h4 fw-bold">Управление клиентами</h3>
                            <p class="text-muted">
                                Централизованное хранение всей информации о клиентах, их контактах и истории взаимодействий.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-success bg-gradient text-white rounded-3 d-inline-flex align-items-center justify-content-center fs-2 mb-3" style="width: 4rem; height: 4rem;">
                                <i class="bi bi-bag-check"></i>
                            </div>
                            <h3 class="h4 fw-bold">Учет заказов</h3>
                            <p class="text-muted">
                                Отслеживание заказов от создания до выполнения. Контроль статусов и сроков доставки.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon bg-info bg-gradient text-white rounded-3 d-inline-flex align-items-center justify-content-center fs-2 mb-3" style="width: 4rem; height: 4rem;">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <h3 class="h4 fw-bold">Простота использования</h3>
                            <p class="text-muted">
                                Интуитивно понятный интерфейс без сложных настроек. Быстрый старт для любой команды.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Benefits Section -->
            <div class="row g-5 mb-5">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <h2 class="h3 fw-bold text-primary mb-4">
                            <i class="bi bi-lightning-charge me-2"></i>
                            Повышение эффективности работы
                        </h2>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem;">
                                    <i class="bi bi-check-lg"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold">Централизованные данные</h5>
                                <p class="text-muted mb-0">
                                    Вся информация о клиентах в одном месте. Забудьте о поиске данных в Excel-таблицах и записных книжках.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem;">
                                    <i class="bi bi-clock"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold">Экономия времени</h5>
                                <p class="text-muted mb-0">
                                    Быстрый поиск и доступ к данным клиентов. Мгновенная информация о заказах и платежах.
                                </p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem;">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h5 class="fw-bold">Снижение ошибок</h5>
                                <p class="text-muted mb-0">
                                    Автоматизация рутинных процессов и единый источник данных минимизируют человеческий фактор.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <h2 class="h3 fw-bold text-success mb-4">
                            <i class="bi bi-rocket-takeoff me-2"></i>
                            Быстрый старт
                        </h2>

                        <div class="alert alert-light border-start border-4 border-primary">
                            <h6 class="fw-bold text-primary">Пример использования:</h6>
                            <p class="mb-2">
                                Клиент звонит с вопросом о заказе. Менеджер вводит номер телефона в поиск и сразу видит:
                            </p>
                            <ul class="mb-0">
                                <li>Полную историю заказов</li>
                                <li>Статус текущих заказов</li>
                                <li>Информацию о платежах</li>
                                <li>Предпочтения клиента</li>
                            </ul>
                        </div>

                        <div class="bg-light rounded-3 p-4 mt-4">
                            <h6 class="fw-bold text-success mb-3">
                                <i class="bi bi-trophy me-2"></i>Преимущества:
                            </h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">✓ Быстрое обучение команды</small>
                                    <small class="text-muted d-block">✓ Низкие затраты на внедрение</small>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">✓ Подходит для малого бизнеса</small>
                                    <small class="text-muted d-block">✓ Простота в обслуживании</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-3">Готовы улучшить работу с клиентами?</h2>
                        <p class="text-muted mb-4">
                            Присоединяйтесь к компаниям, которые уже используют нашу CRM-систему для роста своего бизнеса.
                        </p>
                        <a href="/site/register" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-arrow-right me-2"></i>Начать бесплатно
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <p>
        <?php echo Yii::$app->user->identity->username; ?> из компании <?php echo Yii::$app->user->identity->company->name; ?>, вы успешно вошли в систему.
    </p>

<?php endif ?>

