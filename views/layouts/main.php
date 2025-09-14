<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => Yii::$app->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['siteName'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);


    if (Yii::$app->user->isGuest) {
        // Для гостей
        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О проекте', 'url' => ['/site/about']],
            ['label' => 'Контакты', 'url' => ['/site/contact']],
            ['label' => 'Вход', 'url' => ['/site/login']],
            ['label' => 'Регистрация', 'url' => ['/site/register']],
        ];
    } else {
        // Для залогиненных пользователей
        $menuItems[] = [
            'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post'],
        ];
    }

    // Рендерим навигацию
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="row">
                <div class="col-md-3">
                    <?php
                    echo \yii\bootstrap5\Nav::widget([
                        'options' => [
                            'class' => 'nav flex-column nav-pills sidebar-menu bg-light p-3 rounded shadow-sm',
                            'style' => 'min-height:200px;'
                        ],
                        'items' => [
                            [
                                'label' => '<i class="bi bi-people"></i> Клиенты',
                                'url' => ['/client/'],
                                'encode' => false
                            ],
                            [
                                'label' => '<i class="bi bi-bag"></i> Заказы',
                                'url' => ['/order/'],
                                'encode' => false
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-9">
                    <?php if (!empty($this->params['breadcrumbs'])): ?>
                        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                    <?php endif ?>

                    <?= Alert::widget() ?>

                    <?= $content ?>
                </div>
            </div>
        <?php else: ?>
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>

            <?= Alert::widget() ?>

            <?= $content ?>
        <?php endif; ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; <?php echo Yii::$app->params['siteName']; ?> <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
