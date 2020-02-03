<?php

namespace frontend\widgets;

use frontend\models\LoginForm;
use Yii;
use yii\base\Widget;

class LoginFormWidget extends Widget
{

    public function run()
    {
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            return $this->render(
                'loginFormWidget',
                [
                    'model' => $model,
                ]
            );
        } else {
            return '';
        }
    }

}