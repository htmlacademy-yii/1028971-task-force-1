<?php


namespace app\models;


use yii\base\Model;
use app\models\Task;
use app\models\Category;

class SearchTask extends Model
{
    public $categories = [];
    public $myCity = null;
    public $remoteWork = null;
    public $period = 'all';
    public $searchTask = null;

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'myCity' => 'Мой город',
            'remoteWork' => 'Удаленная работа',
            'period' => 'Период',
            'searchTask' => 'Поиск по названию'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'myCity', 'remoteWork', 'period', 'searchTask'], 'safe'],
            [['myCity', 'isStatusNew', 'remoteWork'], 'boolean'],
            ['searchTask', 'string']
        ];
    }


}
