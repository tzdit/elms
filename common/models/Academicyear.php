<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "academicyear".
 *
 * @property int $yearID
 * @property int $starts_in
 * @property int $ends_in
 * @property string $date_launched
 * @property string $status ex: ongoing or finished
 *
 * @property Course[] $courses
 * @property Logs[] $logs
 * @property Notification[] $notifications
 * @property Notification[] $notifications0
 * @property Notification[] $notifications1
 * @property Notification[] $notifications2
 * @property Notification[] $notifications3
 * @property Notification[] $notifications4
 * @property Notification[] $notifications5
 * @property Notification[] $notifications6
 * @property Notification[] $notifications7
 */
class Academicyear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'academicyear';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['starts_in', 'ends_in', 'date_launched', 'status'], 'required'],
            [['starts_in', 'ends_in'], 'integer'],
            [['date_launched'], 'safe'],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'yearID' => 'Year ID',
            'starts_in' => 'Starts In',
            'ends_in' => 'Ends In',
            'date_launched' => 'Date Launched',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Courses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Logs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications0()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications1()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications2()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications3]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications3()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications4]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications4()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications5]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications5()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications6]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications6()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }

    /**
     * Gets query for [[Notifications7]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications7()
    {
        return $this->hasMany(Notification::className(), ['yearID' => 'yearID']);
    }
}
