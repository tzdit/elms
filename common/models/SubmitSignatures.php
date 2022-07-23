<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "submit_signatures".
 *
 * @property int $subsigID
 * @property int $submitID
 * @property string $reg_no
 * @property string $sigtime
 *
 * @property GroupAssignmentSubmit $submit
 * @property Student $regNo
 */
class SubmitSignatures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'submit_signatures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['submitID', 'reg_no', 'sigtime'], 'required'],
            [['submitID'], 'integer'],
            [['sigtime'], 'safe'],
            [['reg_no'], 'string', 'max' => 20],
            [['submitID'], 'exist', 'skipOnError' => true, 'targetClass' => GroupAssignmentSubmit::className(), 'targetAttribute' => ['submitID' => 'submitID']],
            [['reg_no'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['reg_no' => 'reg_no']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subsigID' => 'Subsig ID',
            'submitID' => 'Submit ID',
            'reg_no' => 'Reg No',
            'sigtime' => 'Sigtime',
        ];
    }

    /**
     * Gets query for [[Submit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmit()
    {
        return $this->hasOne(GroupAssignmentSubmit::className(), ['submitID' => 'submitID']);
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

    public function signSubmit($submitID)
    {
        $this->submitID=$submitID;
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $this->sigtime=date('Y-m-d H:i:s');
        $this->reg_no=yii::$app->user->identity->student->reg_no;

        try
        {
            if($this->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(\Exception $d)
        {
            return false;
        }
    }

    public function isSigned($submitID,$regno)
    {
        return $this->find()->where(['submitID'=>$submitID,'reg_no'=>$regno])->one()!=null;
    }
}
