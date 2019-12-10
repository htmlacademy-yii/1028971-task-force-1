<?php


namespace frontend\controllers;

use yii\web\Controller;
use app\models\Task;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Task::find()->where(['status_id' => 1])->orderBy('creation_date DESC')->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}