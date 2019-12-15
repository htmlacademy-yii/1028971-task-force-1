<?php


namespace app\models;


use yii\base\Model;
use app\models\Task;
use app\models\Category;

class SearchTask extends Model
{
    public $categories = [];
    public $myCity = null;
    public $isStatusNew = null;
    public $remoteWork = null;
    public $period = null;
    public $searchTask = null;

    public function attributeLabels()
    {
        return [
            'categories' => 'категории',
            'myCity' => 'Мой город',
            'isStatusNew' => 'Без исполнителя',
            'remoteWork' => 'Удаленная работа',
            'period' => 'Период',
            'searchTask' => 'Поиск по названию'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'myCity', 'isStatusNew', 'remoteWork', 'period', 'searchTask'], 'safe'],
            [['myCity', 'isStatusNew', 'remoteWork'], 'boolean'],
            ['searchTask', 'string', 'length' => [5]]
        ];
    }


}
