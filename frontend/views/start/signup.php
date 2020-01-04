<?php

/* @var $this yii\web\View */
/* @var $model frontend\models\SignupForm */


$this->title = 'Регистрация аккаунта';

use yii\widgets\ActiveForm;

?>

<section class="registration__user">
    <h1>Регистрация аккаунта</h1>
    <div class="registration-wrapper">
        <?php $form = \yii\widgets\ActiveForm::begin([
            'id' => 'registration__user-form',
            'options' => ['class' => 'registration__user-form form-create', 'enableAjaxValidation' => true]
        ]) ?>

        <?= $form->field($model, 'email')
            ->textInput(['name' => 'email', 'placeholder' => 'kumarm@mail.ru', 'id' => 16, 'rows' => 1])
            ->label('Электронная почта')
            ->hint('Введите валидный адрес электронной почты', ['tag' => 'span']) ?>

        <?= $form->field($model, 'name')
            ->textInput(['name' => 'name', 'placeholder' => 'Мамедов Кумар', 'id' => 17, 'rows' => 1])
            ->label('Ваше имя')
            ->hint('Введите ваше имя и фамилию', ['tag' => 'span']) ?>

        <?php
        $items = yii\helpers\ArrayHelper::map(\app\models\City::find()->all(), "id", "city");
        $params = [
            'class' => 'multiple-select input town-select registration-town',
            'id' => 18,
            'size' => 1,
            'name' => 'city_id'
        ];

        echo $form->field($model, 'city_id')
            ->dropDownList($items, $params)
            ->label('Город проживания')
            ->hint('Укажите город, чтобы находить подходящие задачи', ['tag' => 'span']) ?>

        <?= $form->field($model, 'password')
            ->textInput([
                'name' => 'password',
                'id' => 19,
                'rows' => 1,
                'class' => 'input textarea',
                'type' => 'password'
            ])
            ->label('Пароль')
            ->hint('Длина пароля от 8 символов', ['tag' => 'span'])

        ?>

        <button class="button button__registration" type="submit">Создать аккаунт</button>
        <?php ActiveForm::end(); ?>
    </div>
</section>
