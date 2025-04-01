<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Client;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList(
        ArrayHelper::map(Client::find()->all(), 'id', 'name'), // Список клиентов
        ['prompt' => 'Выберите клиента'] // Подсказка в выпадающем списке
    ) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control'],
    ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
