<?php


namespace frontend\controllers;

use app\models\SearchTask;
use app\models\Task;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TasksController extends Controller
{
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) {
            $this->redirect(Url::to('@web/start'));
        }

        $filterCategories = null;
        $searchModel = new SearchTask();

        if (Yii::$app->request->getIsPost()) {
            $searchModel->load(Yii::$app->request->post());
            $filterCategories = is_array($searchModel->categories)
                ? array_map('intval',
                    $searchModel->categories) : [];
        }

        $query = Task::find()
            ->where(['status_id' => 1])
            ->joinWith('category')
            ->orderBy('creation_date DESC');

        if ($filterCategories) {
            $query->andWhere(['category_id' => $filterCategories]);
        }

        if ($searchModel->myCity) {
            $query->andWhere(['city_id' => 396]); //todo заменить на id из профиля пользователя
        }

        if ($searchModel->remoteWork) {
            $query->andWhere(['is', 'city_id', null]);
        }

        switch ($searchModel->period) {
            case 'day':
                $query->andWhere(['>', 'creation_date', new Expression('CURRENT_TIMESTAMP() - INTERVAL 1 DAY')]);
                break;
            case 'week':
                $query->andWhere(['>', 'creation_date', new Expression('CURRENT_TIMESTAMP() - INTERVAL 7 DAY')]);
                break;
            case 'month':
                $query->andWhere(['>', 'creation_date', new Expression('CURRENT_TIMESTAMP() - INTERVAL 30 DAY')]);
                break;
        }

        if ($searchModel->searchTask) {
            $query->andWhere("MATCH(task.description, task.name) AGAINST ('$searchModel->searchTask')");
        }

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]);
        $tasks = $query->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('index', compact('tasks', 'searchModel', 'pages'));
    }

    public function actionView($id)
    {
        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задание с ID $id не найдено");
        }

        return $this->render('view', ['task' => $task]);
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}

