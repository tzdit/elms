<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "college".
 *
 * @property int $collegeID
 * @property string $college_name
 * @property string $college_abbrev
 *
 * @property Admin[] $admins
 * @property Department[] $departments
 */
class College extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'college';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['college_name', 'college_abbrev'], 'required'],
            [['college_name'], 'string', 'max' => 50],
            [['college_abbrev'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'collegeID' => 'College ID',
            'college_name' => 'College Name',
            'college_abbrev' => 'College Abbrev',
        ];
    }

    /**
     * Gets query for [[Admins]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['collegeID' => 'collegeID']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['collegeID' => 'collegeID']);
    }
}
