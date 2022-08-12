<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "studentstatus".
 *
 * @property int $ssID
 * @property string|null $status
 * @property string|null $employmentstatsafter
 * @property string $reg_no
 *
 * @property Student $regNo
 */
class Studentstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_no'], 'required'],
            [['status', 'reg_no'], 'string', 'max' => 20],
            [['employmentstatsafter'], 'string', 'max' => 30],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ssID' => 'Ss ID',
            'status' => 'Status',
            'employmentstatsafter' => 'Employmentstatsafter',
            'reg_no' => 'Reg No',
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
}
