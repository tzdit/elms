<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "studentguardianinfo".
 *
 * @property int $infoID
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $address
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $occupation
 * @property string $disabled
 * @property string $reg_no
 *
 * @property Student $regNo
 */
class Studentguardianinfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentguardianinfo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname','mname','lname', 'address', 'disabled', 'reg_no'], 'required'],
            [['address', 'email'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 15],
            [['occupation', 'reg_no'], 'string', 'max' => 20],
            [['disabled'], 'string', 'max' => 5],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'infoID' => 'Info ID',
            'address' => 'Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'occupation' => 'Occupation',
            'disabled' => 'Disabled',
            'fname' => 'First Name',
            'mname' => 'Middle Name',
            'lname' => 'Last Name',
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
