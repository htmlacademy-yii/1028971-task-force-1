<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $reg_date
 * @property string|null $birthday
 * @property string $email
 * @property string $password
 * @property string|null $avatar
 * @property string|null $last_activity
 * @property string|null $portfolio
 * @property string|null $info
 * @property int|null $phone
 * @property string|null $skype
 * @property string|null $other_contacts
 * @property int $city_id
 * @property int $hide_contacts
 * @property int $hide_profile
 * @property int $is_executor
 *
 * @property Bookmarked[] $bookmarkeds
 * @property Bookmarked[] $bookmarkeds0
 * @property Feedback[] $feedbacks
 * @property Feedback[] $feedbacks0
 * @property Message[] $messages
 * @property Message[] $messages0
 * @property Response[] $responses
 * @property Task[] $tasks
 * @property City $city
 * @property UserAlerts[] $userAlerts
 * @property UserPortfolio[] $userPortfolios
 * @property UserSpecialization[] $userSpecializations
 * @property WorkTask[] $workTasks
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'reg_date', 'email', 'password', 'city_id'], 'required'],
            [['reg_date', 'birthday', 'last_activity'], 'safe'],
            [['phone', 'city_id', 'hide_contacts', 'hide_profile', 'is_executor'], 'integer'],
            [['name', 'email', 'skype', 'other_contacts'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 255],
            [['avatar', 'portfolio', 'info'], 'string', 'max' => 512],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'reg_date' => 'Reg Date',
            'birthday' => 'Birthday',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'avatar' => 'Avatar',
            'last_activity' => 'Last Activity',
            'portfolio' => 'Portfolio',
            'info' => 'Info',
            'phone' => 'Phone',
            'skype' => 'Skype',
            'other_contacts' => 'Other Contacts',
            'city_id' => 'City ID',
            'hide_contacts' => 'Hide Contacts',
            'hide_profile' => 'Hide Profile',
            'is_executor' => 'Is Executor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarkeds()
    {
        return $this->hasMany(Bookmarked::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarkeds0()
    {
        return $this->hasMany(Bookmarked::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks0()
    {
        return $this->hasMany(Feedback::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['sender_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages0()
    {
        return $this->hasMany(Message::className(), ['recipient_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['executor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAlerts()
    {
        return $this->hasMany(UserAlerts::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPortfolios()
    {
        return $this->hasMany(UserPortfolio::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSpecializations()
    {
        return $this->hasMany(UserSpecialization::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkTasks()
    {
        return $this->hasMany(WorkTask::className(), ['executor_id' => 'id']);
    }
}
