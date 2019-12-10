<?php


namespace frontend\controllers;

use yii\web\Controller;
use app\models\Task;

class TasksController extends Controller
{
    public function actionTasks()
    {
        return $this->render('tasks');
    }
}