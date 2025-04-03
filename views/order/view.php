<?php

use app\models\Expense;
use app\models\Payment;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vert-margin80">

    <h1 class="vert-margin30">Заказ №<?= Html::encode($this->title) ?> (<?php echo $model->client->name ?>)
        <?= Html::a('<i class="bi bi-pencil"></i> Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="bi bi-trash"></i> Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </h1>

    <div class="row">
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    [
                        'attribute' => 'client_id',
                        'label' => 'Клиент', // Опционально: задаем заголовок
                        'format' => 'raw', // Разрешаем HTML
                        'value' => function ($model) {
                            return Html::a(Html::encode($model->client->name), ['client/view', 'id' => $model->client->id]);
                        },
                    ],
                    [
                        'attribute' => 'amount',
                        'label' => 'Сумма заказа', // Опционально: задаем заголовок
                        'format' => ['decimal', 2], // 2 знака после запятой
                        'value' => function ($model) {
                            return $model->amount;
                        },
                    ],
                    'start_date',
                    'created_at',
                ],
            ]) ?>
        </div>
        <div class="col-md-4 align-content-center center-align">
            <?php
            echo '<h3>Прибыль: ' . number_format($model->getProfit(), 2, '.', ' ') . ' руб.</h3>'; ?>
        </div>

        </div>

</div>



<div class="row">
    <div class="col-md-6">

        <div class="vert-margin80">
            <!-- Список оплат -->
            <h4>Оплаты по заказу (<?php echo number_format($model->getTotalPayments(), 2, '.', ' '); ?>)</h4>
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => Payment::find()->where(['order_id' => $model->id]),
                    'pagination' => false, // Отключаем пагинацию, если нужно все записи
                    'sort' => false, // Отключаем сортировку
                ]),
                'summary' => '',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'], // Номера строк
                    'payment_date',
                    [
                        'attribute' => 'amount',
                        'label' => 'Сумма', // Опционально: задаем заголовок
                        'format' => ['decimal', 2], // 2 знака после запятой
                        'value' => function ($model) {
                            return $model->amount;
                        },
                    ],
                    //'created_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'payment', // Указываем контроллер для оплат
                        'template' => '{update} {delete}',  // кнопки
                    ],
                ],
            ]) ?>
        </div>
        <!-- Форма для создания оплаты -->
        <div class="add-form">
            <h5>Добавить оплату</h5>
            <?php
                $payment = new Payment();
                $payment->order_id = $model->id; // Привязываем к текущему заказу
                $form = ActiveForm::begin([
                    'action' => ['order/add-payment', 'id' => $model->id], // Указываем action для обработки
                ]);
            ?>
            <?= $form->field($payment, 'amount')->textInput() ?>
            <?= $form->field($payment, 'payment_date')->widget(DatePicker::class, [
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control'],
            ]) ?>
            <?= Html::submitButton('<i class="bi bi-patch-plus"></i> Добавить оплату', ['class' => 'btn btn-success']) ?>
            <?php
            ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-md-6">

        <div class="vert-margin80">
            <!-- Список расходов -->
            <h4>Расходы по заказу (<?php echo number_format($model->getTotalExpenses(), 2, '.', ' '); ?>)</h4>
            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => Expense::find()->where(['order_id' => $model->id]),
                    'pagination' => false,
                    'sort' => false, // Отключаем сортировку
                ]),
                'summary' => '',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'expense_date',
                    [
                        'attribute' => 'amount',
                        'label' => 'Сумма', // Опционально: задаем заголовок
                        'format' => ['decimal', 2], // 2 знака после запятой
                        'value' => function ($model) {
                            return $model->amount;
                        },
                    ],
                    'description',

                    //'created_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'controller' => 'expense', // Указываем контроллер для оплат
                        'template' => '{update} {delete}',
                    ],
                ],
            ]) ?>
        </div>

        <div class="add-form">
            <!-- Форма для создания расхода -->
            <h5>Добавить расход</h5>
            <?php
            $expense = new Expense();
            $expense->order_id = $model->id; // Привязываем к текущему заказу
            $form = ActiveForm::begin([
                'action' => ['order/add-expense', 'id' => $model->id], // Указываем action для обработки
            ]);
            ?>
            <?= $form->field($expense, 'amount')->textInput() ?>
            <?= $form->field($expense, 'description')->textarea(['rows' => 5, 'maxlength' => true]) ?>
            <?= $form->field($expense, 'expense_date')->widget(DatePicker::class, [
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'form-control'],
            ]) ?>
            <?= Html::submitButton('<i class="bi bi-patch-minus"></i> Добавить расход', ['class' => 'btn btn-success']) ?>
            <?php
            ActiveForm::end(); ?>
        </div>
    </div>
</div>





