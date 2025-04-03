<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Expense $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
    <div class="col-md-6">
        <div class="add-form">

            <?php
            $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 5, 'maxlength' => true]) ?>

            <?= $form->field($model, 'expense_date')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php
            ActiveForm::end(); ?>

        </div>
    </div>
</div>
