<?php

use app\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?>
        <?= Html::a('<i class="bi bi-patch-plus"></i>  Новый клиент', ['create'], ['class' => 'btn btn-success']) ?>
    </h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => 'Имя клиента', // Опционально: задаем заголовок
                'format' => 'raw', // Разрешаем HTML
                'value' => function ($model) {
                    return Html::a(Html::encode($model->name), ['client/view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания', // Опционально: задаем заголовок
                'format' => ['date', 'php:Y-m-d '], // Формат даты и времени
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Client $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]) ?>


</div>
