<?php

/* @var $model frontend\models\LoginForm */


?>
<section class="modal enter-form form-modal" id="form-modal">
    <h2>Вход на сайт</h2>
    <?php use yii\widgets\ActiveForm;
    $form = ActiveForm::begin(
        [
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'action' => ['index']
        ]
    ) ?>
    <p>
        <?= $form->field($model, 'email')
            ->textInput(
                [
                    'name' => 'email',
                    'type' => 'email',
                    'id' => 'enter-email',
                    'class' => 'enter-form-email input input-middle'
                ]
            )
            ->label('Электронная почта', ['class' => 'form-modal-description']) ?>
        <!--        <label class="form-modal-description" for="enter-email">Email</label>-->
        <!--        <input class="enter-form-email input input-middle" type="email" name="enter-email" id="enter-email">-->
    </p>
    <p>
        <?= $form->field($model, 'password')
            ->passwordInput(
                [
                    'name' => 'password',
                    'id' => 'enter-password',
                    'type' => 'password',
                    'class' => 'enter-form-email input input-middle'
                ]
            )
            ->label('Пароль',
                [
                    'class' => 'form-modal-description'
                ])
        ?>
        <!--        <label class="form-modal-description" for="enter-password">Пароль</label>-->
        <!--        <input class="enter-form-email input input-middle" type="password" name="enter-email" id="enter-password">-->
    </p>
    <button class="button" type="submit">Войти</button>
    <?php ActiveForm::end(); ?>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>
