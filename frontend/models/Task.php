<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $category_id
 * @property int $author_id
 * @property string|null $files
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $address
 * @property string $creation_date
 * @property string|null $end_date
 * @property int|null $status_id
 * @property int|null $budget
 * @property int|null $city_id
 *
 * @property Response[] $responses
 * @property Category $category
 * @property User $author
 * @property Status $status
 * @property WorkTask[] $workTasks
 * @property City $city
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'author_id', 'creation_date'], 'required'],
            [['description', 'address'], 'string'],
            [['category_id', 'author_id', 'status_id', 'budget', 'city_id'], 'integer'],
            [['creation_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['files'], 'string', 'max' => 512],
            [['latitude', 'longitude'], 'string', 'max' => 30],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'files' => 'Files',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address',
            'creation_date' => 'Creation Date',
            'end_date' => 'End Date',
            'status_id' => 'Status ID',
            'budget' => 'Budget',
            'city_id' => 'City'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkTasks()
    {
        return $this->hasMany(WorkTask::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasMany(City::className(), ['city_id' => 'id']);
    }
}
