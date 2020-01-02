<?php

namespace frontend\models;

use app\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $city_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Это имя уже существует.'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Этот адрес уже существует.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 8],

            ['city_id', 'safe'],
        ];
    }


    public function attributeLabels() {
        return [
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'city_id' => 'Город',
        ];
    }


}
