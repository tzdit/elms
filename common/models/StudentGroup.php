<?php

namespace common\models;

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
            'SG_ID' => 'Sg ID',
            'reg_no' => 'Reg No',
            'groupID' => 'Group ID',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['groupID' => 'groupID']);
    }

    /**
     * Gets query for [[RegNo]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getRegNo()
    {
        return $this->hasOne(Student::className(), ['reg_no' => 'reg_no']);
    }

    /**
     * {@inheritdoc}
     * @return StudentGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentGroupQuery(get_called_class());
    }
}
