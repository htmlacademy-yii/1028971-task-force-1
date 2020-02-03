<?php


namespace frontend\controllers;

use frontend\models\LoginForm;
use frontend\models\SignupForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class StartController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'landing';
        $loginForm = new LoginForm();
        if (Yii::$app->request->getIsPost()) {
            $loginForm->attributes = Yii::$app->request->post();
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('index');
    }

    public function actionSignup()
    {
        $this->layout = 'signup';
        $model = new SignupForm();

        if (Yii::$app->request->getIsPost()) {
            $model->attributes = Yii::$app->request->post();

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->validate()) {
                $model->signup();
                return $this->redirect(Url::to('@web/tasks'));
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

//    public function actionLogin()
//    {
//        $loginForm = new LoginForm();
//        if (Yii::$app->request->getIsPost()) {
//            $loginForm->load(Yii::$app->request->post());
//            if ($loginForm->validate()) {
//                $user = $loginForm->getUser();
//                Yii::$app->user->login($user);
//                return $this->goHome();
//            }
//        }
//        return $this->render('index', compact('loginForm'));
//    }

//    public function actionAjaxLogin() {
//        if (Yii::$app->request->isAjax) {
//            $model = new LoginForm();
//            if ($model->load(Yii::$app->request->post())) {
//                if ($model->login()) {
//                    return $this->redirect(Url::to('@web/tasks'));
//                } else {
//                    Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
//                    return \yii\widgets\ActiveForm::validate($model);
//                }
//            }
//        } else {
//            throw new HttpException(404 ,'Page not found');
//        }
//    }

}
