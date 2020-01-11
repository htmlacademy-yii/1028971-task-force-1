<?php


namespace frontend\controllers;

use frontend\models\SignupForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;
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
        $model = new SignupForm();

        if (Yii::$app->request->getIsPost()) {
            $model->attributes = Yii::$app->request->post();

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->validate()) {
                $model->signup();
                return $this->redirect('/tasks');
            }
        }
        return $this->render('signup', ['model' => $model]);
    }

}
