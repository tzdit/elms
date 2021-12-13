<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $chatID
 * @property string|null $reg_no
 * @property int|null $instructorID
 * @property string $chatText
 * @property string $chatDate
 * @property string $chatTime
 * @property string $status
 *
 * @property Student $regNo
 * @property Instructor $instructor
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
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
            [['instructorID'], 'integer'],
            [['chatText', 'chatDate', 'chatTime', 'status', 'reg_no'], 'required'],
            [['chatDate', 'chatTime'], 'safe'],
            [['reg_no'], 'string', 'max' => 20],
            [['chatText'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 10],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chatID' => 'Chat ID',
            'reg_no' => 'Reg No',
            'instructorID' => 'Instructor ID',
            'chatText' => 'Chat Text',
            'chatDate' => 'Chat Date',
            'chatTime' => 'Chat Time',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
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
}
