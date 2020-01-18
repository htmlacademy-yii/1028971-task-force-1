<?php


namespace frontend\controllers;

use app\models\SearchTask;
use app\models\Task;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $filterCategories = null;
        $searchModel = new SearchTask();

        if (Yii::$app->request->getIsPost()) {
            $searchModel->load(Yii::$app->request->post());
            $filterCategories = is_array($searchModel->categories)
                ? array_map('intval',
                    $searchModel->categories) : [];
        }

        $tasks = Task::find()
            ->where(['status_id' => 1])
            ->joinWith('category')
            ->orderBy('creation_date DESC');

        if ($filterCategories) {
            $tasks->andWhere(['category_id' => $filterCategories]);
        }

        if ($searchModel->myCity) {
            $tasks->andWhere(['city_id' => 396]); //todo заменить на id из профиля пользователя
        }

        if ($searchModel->remoteWork) {
            $tasks->andWhere(['is', 'city_id', null]);
        }

        switch ($searchModel->period) {
            case 'day':
                $tasks->andWhere(['>', 'creation_date', new Expression('CURRENT_TIMESTAMP() - INTERVAL 1 DAY')]);
                break;
            case 'week':
                $tasks->andWhere(['>', 'creation_date', new Expression('CURRENT_TIMESTAMP() - INTERVAL 7 DAY')]);
                break;
            case 'month':
                $tasks->andWhere(['>', 'creation_date', new Expression('CURRENT_TIMESTAMP() - INTERVAL 30 DAY')]);
                break;
        }

        if ($searchModel->searchTask) {
            $tasks->andWhere("MATCH(task.description, task.name) AGAINST ('$searchModel->searchTask')");
        }

        $tasks = $tasks->all();


        return $this->render('index', compact('tasks', 'searchModel'));
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задание с ID $id не найдено");
        }

        return $this->render('view', ['task' => $task]);
    }
}

