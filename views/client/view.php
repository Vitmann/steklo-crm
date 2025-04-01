<?php

use app\models\Order;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Client $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <h1 class="vert-margin30"><?= Html::encode($this->title) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Информация о заказчике:</h3>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    //'created_at',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <!-- Список заказов клиента -->
            <h3>Заказы клиента</h3>
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => Order::find()->where(['client_id' => $model->id]),
                    'pagination' => false, // Отключаем пагинацию, если нужно все записи
                    'sort' => false, // Отключаем сортировку
                ]),
                'summary' => '',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    [
                        'attribute' => 'amount',
                        'label' => 'Сумма заказа', // Опционально: задаем заголовок
                        'format' => 'raw', // Разрешаем HTML
                        'value' => function ($model) {
                            return Html::a(Html::encode(number_format($model->amount, 2, '.', ' ')), ['order/view', 'id' => $model->id]);
                        },
                    ],
                    'start_date',
                    [
                        'label' => 'Прибыль', // Заголовок колонки
                        'value' => function ($model) {
                            return $model->getProfit(); // Вызов метода getProfit()
                        },
                        'format' => ['decimal', 2], // Формат с двумя знаками после запятой
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'order',
                        'template' => '{view}', // Кнопка просмотра заказа
                    ],
                ],
            ]) ?>
            <?= Html::a('Создать новый заказ', ['order/create', 'client_id' => $model->id], ['class' => 'btn btn-success']) ?>
        </div>

    </div>



</div>
