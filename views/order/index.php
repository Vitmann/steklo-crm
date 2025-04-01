<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?>
        <?= Html::a('Новый заказ', ['create'], ['class' => 'btn btn-success']) ?>

    </h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'client_id',
                'label' => 'Клиент', // Опционально: задаем заголовок
                'format' => 'raw', // Разрешаем HTML
                'value' => function ($model) {
                    return Html::a(Html::encode($model->client->name), ['client/view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'amount',
                'label' => 'Сумма заказа', // Опционально: задаем заголовок
                'format' => 'raw', // Разрешаем HTML
                'value' => function ($model) {
                    return Html::a(Html::encode(number_format($model->amount, 2, '.', ' ')), ['order/view', 'id' => $model->id]);
                },
            ],
            'start_date',
            //'created_at',
            [
                'label' => 'Прибыль', // Заголовок колонки
                'value' => function ($model) {
                    return $model->getProfit(); // Вызов метода getProfit()
                },
                'format' => ['decimal', 2], // Формат с двумя знаками после запятой
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
