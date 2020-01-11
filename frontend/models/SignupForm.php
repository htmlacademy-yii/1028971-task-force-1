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
    public $reg_date;

    public static function tableName()
    {
        return 'user';
    }

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

            ['city_id', 'integer'],

            ['reg_date', 'safe']
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

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->city_id = $this->city_id;
        $user->reg_date = $this->reg_date;
        $user->password = password_hash($this->password,PASSWORD_DEFAULT);
        return $user->save(false);

    }


}
