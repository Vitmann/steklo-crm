<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Contact $model */
/** @var app\models\Client $client */

$this->title = 'Новый контакт для: ' . $client->name;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['client/index']];
$this->params['breadcrumbs'][] = ['label' => $client->name, 'url' => ['client/view', 'id' => $client->id]];
$this->params['breadcrumbs'][] = $this->title;

// Регистрируем JS для маски телефона
$this->registerJs(<<<JS
    $(document).ready(function(){
        $('#contact-phone').inputmask('+7 (999) 999-99-99', {
            placeholder: '+7 (___) ___-__-__',
            clearMaskOnLostFocus: false
        });
    });
JS
);
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
    <div class="col-md-6">
        <div class="add-form">
            <?php
            $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'post')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'comment')->textarea(['rows' => 5]) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Отмена', ['client/view', 'id' => $client->id], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?php
            ActiveForm::end(); ?>
        </div>
    </div>
</div>