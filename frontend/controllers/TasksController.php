<?php


namespace frontend\controllers;

use yii\web\Controller;
use app\models\Task;
use app\models\Category;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $categories = Category::find()->all();
        $tasks = Task::find()->where(['status_id' => 1])->orderBy('creation_date DESC')->all();

        return $this->render('index', compact('tasks', 'categories'));
    }
}
