<?php

namespace common\models;

use Yii;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use frontend\models\ClassRoomBehaviours;
/**
 * This is the model class for table "module".
 *
 * @property int $moduleID
 * @property string $moduleName
 * @property string|null $module_description
 * @property string $course_code
 *
 * @property Material[] $materials
 * @property Material[] $materials0
 * @property Course $courseCode
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
             'classroombehaviours' => [
                'class' => ClassRoomBehaviours::class
             ]
        ];
    }
    public static function tableName()
    {
        return 'module';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['moduleName', 'course_code'], 'required'],
            [['moduleName'], 'string', 'max' => 200],
            [['module_description'], 'string', 'max' => 400],
            [['course_code'], 'string', 'max' => 15],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'moduleID' => 'Module ID',
            'moduleName' => 'Module Name',
            'module_description' => 'Module Description',
            'course_code' => 'Course Code',
        ];
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['moduleID' => 'moduleID']);
    }

    /**
     * Gets query for [[Materials0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials0()
    {
        return $this->hasMany(Material::className(), ['moduleID' => 'moduleID']);
    }

    /**
     * Gets query for [[CourseCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode()
    {
        return $this->hasOne(Course::className(), ['course_code' => 'course_code']);
    }
}
