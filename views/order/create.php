<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Order $model */

$this->title = 'Новый заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="row">
        <div class="col-md-4">
            <div class="add-form">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
