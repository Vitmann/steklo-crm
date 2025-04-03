<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Payment $model */

$this->title = 'Редактирование оплаты: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Оплаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>

<div class="row">
    <div class="col-md-6">
        <div class="add-form">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
