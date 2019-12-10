<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_alerts".
 *
 * @property int $id
 * @property int $alert_id
 * @property int $user_id
 *
 * @property Notification $alert
 * @property User $user
 */
class UserAlerts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_alerts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alert_id', 'user_id'], 'required'],
            [['alert_id', 'user_id'], 'integer'],
            [['alert_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::className(), 'targetAttribute' => ['alert_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alert_id' => 'Alert ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlert()
    {
        return $this->hasOne(Notification::className(), ['id' => 'alert_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
