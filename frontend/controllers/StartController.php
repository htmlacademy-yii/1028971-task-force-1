<?php


namespace frontend\controllers;

use app\models\User;
use yii\web\Response;
use Yii;
use yii\web\Controller;
use yii\widgets\ActiveForm;

class StartController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'landing';
        return $this->render('index');
    }

    public function actionSignup()
    {
        $this->layout = 'signup';
        $user = new User();
        if (Yii::$app->request->getIsPost()) {
            $user->load(Yii::$app->request->post());
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return ActiveForm::validate($user);
            }
            if ($user->validate()) {
                $user->save();
            }
        }

        return $this->render('signup', ['model' => $user]);
    }

}
