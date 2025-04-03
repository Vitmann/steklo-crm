<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Payment $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Оплаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-6">
        <div class="add-form">
            <h1>Транзаккция: №<?= Html::encode($this->title) ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </h1>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'order_id',
                    'amount',
                    'payment_date',
                    'created_at',
                ],
            ]) ?>

        </div>
    </div>
</div>
