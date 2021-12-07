<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "instructor_notification".
 *
 * @property int $IN_ID
 * @property int|null $instructorID
 * @property int|null $notif_ID
 *
 * @property Instructor $instructor
 * @property Notification $notif
 */
class StudentNotification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instructor_notification';
    }
    
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'notif_ID'], 'integer'],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
            [['notif_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Notification::className(), 'targetAttribute' => ['notif_ID' => 'notif_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IN_ID' => 'In ID',
            'instructorID' => 'Instructor ID',
            'notif_ID' => 'Notif ID',
        ];
    }

    /**
     * Gets query for [[Instructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructor()
    {
        return $this->hasOne(Instructor::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Notif]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotif()
    {
        return $this->hasOne(Notification::className(), ['notif_ID' => 'notif_ID']);
    }
}
