<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "student_ext_assess".
 *
 * @property int $student_assess_id
 * @property string $reg_no
 * @property float $score
 * @property int $assessID
 *
 * @property ExtAssess $assess
 * @property Student $regNo
 */
class StudentExtAssess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_ext_assess';
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
            [['reg_no', 'score', 'assessID'], 'required'],
            [['score'], 'number'],
            [['assessID'], 'integer'],
            [['reg_no'], 'string', 'max' => 20],
            [['reg_no', 'assessID'], 'unique', 'targetAttribute' => ['reg_no', 'assessID'],'message'=>'Record already exists in this assessment'],
            [['assessID'], 'exist', 'skipOnError' => true, 'targetClass' => ExtAssess::className(), 'targetAttribute' => ['assessID' => 'assessID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_assess_id' => 'Student Assess ID',
            'reg_no' => 'Reg No',
            'score' => 'Score',
            'assessID' => 'Assess ID',
        ];
    }

    /**
     * Gets query for [[Assess]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssess()
    {
        return $this->hasOne(ExtAssess::className(), ['assessID' => 'assessID']);
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
