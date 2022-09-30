<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use frontend\models\ClassRoomBehaviours;
use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $material_ID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string|null $title
 * @property string|null $material_type
 * @property string|null $upload_date
 * @property string|null $upload_time
 * @property string|null $fileName
 * @property int $yearID
 * @property int|null $moduleID
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property Module $module
 * @property Module $module0
 */
class Material extends \yii\db\ActiveRecord
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
             ],
        ];
    }
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'yearID', 'moduleID'], 'integer'],
            [['upload_date', 'upload_time'], 'safe'],
            [['yearID'], 'required'],
            [['course_code'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 100],
            [['material_type'], 'string', 'max' => 15],
            [['fileName'], 'string', 'max' => 300],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
            [['moduleID'], 'exist', 'skipOnError' => true, 'targetClass' => Module::className(), 'targetAttribute' => ['moduleID' => 'moduleID']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'material_ID' => 'Material ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'title' => 'Title',
            'material_type' => 'Material Type',
            'upload_date' => 'Upload Date',
            'upload_time' => 'Upload Time',
            'fileName' => 'File Name',
            'yearID' => 'Year ID',
            'moduleID' => 'Module ID',
        ];
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

    /**
     * Gets query for [[Instructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructor()
    {
        return $this->hasOne(Instructor::className(), ['instructorID' => 'instructorID']);
    }

    /**
     * Gets query for [[Module]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['moduleID' => 'moduleID']);
    }

    /**
     * Gets query for [[Module0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModule0()
    {
        return $this->hasOne(Module::className(), ['moduleID' => 'moduleID']);
    }


    function getVideoAndNotesLink($file_name){

        $document_path = '/storage/temp/'.$file_name;
        if(file_exists($document_path)){
            return $document_path;
        }

        return false;

        
    }

    public function isNew()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $time=strtotime($this->upload_date.' '.$this->upload_time);
        $lastlogin=yii::$app->user->identity->last_login;
        $lastlogin=strtotime($lastlogin);

        return $lastlogin<$time;
    }
}
