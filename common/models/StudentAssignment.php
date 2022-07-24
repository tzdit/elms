<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "student_assignment".
 *
 * @property int $std_assID
 * @property int|null $assID
 * @property string|null $reg_no
 *
 * @property Assignment $ass
 * @property Student $regNo
 */
class StudentAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_assignment';
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
            [['assID'], 'integer'],
            [['reg_no'], 'string', 'max' => 20],
            [['assID'], 'exist', 'skipOnError' => true, 'targetClass' => Assignment::className(), 'targetAttribute' => ['assID' => 'assID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'std_assID' => 'Std Ass ID',
            'assID' => 'Ass ID',
            'reg_no' => 'Reg No',
        ];
    }

    /**
     * Gets query for [[Ass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAss()
    {
        return $this->hasOne(Assignment::className(), ['assID' => 'assID']);
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
}
