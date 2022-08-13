<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "studenteducation".
 *
 * @property int $educID
 * @property string $level
 * @property string $type
 * @property string $intake
 * @property string $reg_no
 *
 * @property Student $regNo
 */
class Studenteducation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studenteducation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_no','level','type','intake'], 'required'],
            [['level'], 'string', 'max' => 30],
            [['type', 'intake', 'reg_no'], 'string', 'max' => 20],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'educID' => 'Educ ID',
            'level' => 'Level',
            'type' => 'Type',
            'intake' => 'Intake',
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
