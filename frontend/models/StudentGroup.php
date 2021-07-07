<?php

namespace frontend\models;
use common\models\Groups;
use common\models\Student;

use Yii;

/**
 * This is the model class for table "student_group".
 *
 * @property int $SG_ID
 * @property string|null $reg_no
 * @property int|null $groupID
 *
 * @property Groups $group
 * @property Student $regNo
 */
class StudentGroup extends \yii\db\ActiveRecord
{

    public $groupName;
    public $course_code;




    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['reg_no', 'unique', 'targetAttribute' => 'groupID'],
            [['groupID'], 'integer'],
            [['reg_no'], 'string', 'max' => 20],
            [['groupID'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupID' => 'groupID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SG_ID' => Yii::t('app', 'Sg ID'),
            'reg_no' => Yii::t('app', 'Reg No'),
            'groupID' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID']);
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
