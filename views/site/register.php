<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6 offset-md-3">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста, заполните форму для регистрации компании и пользователя:</p>
    <?php $form = ActiveForm::begin(['id' => 'form-register']); ?>
        <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>
        <div class="form-group mt-3">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
