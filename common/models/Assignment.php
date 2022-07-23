<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use frontend\models\CourseStudents;
use frontend\models\ClassRoomSecurity;
use frontend\models\ClassRoomBehaviours;
use Yii;

/**
 * This is the model class for table "assignment".
 *
 * @property int $assID
 * @property int|null $instructorID
 * @property string|null $course_code
 * @property string $assName
 * @property string|null $assType
 * @property string $assNature
 * @property string|null $ass_desc
 * @property string|null $submitMode
 * @property string|null $finishDate
 * @property int|null $total_marks
 * @property string|null $fileName
 * @property int $yearID
 * @property string $status
 * @property string $create_time
 *
 * @property Course $courseCode
 * @property Instructor $instructor
 * @property Assq[] $assqs
 * @property GroupAssignment[] $groupAssignments
 * @property GroupAssignmentSubmit[] $groupAssignmentSubmits
 * @property GroupGenerationAssignment[] $groupGenerationAssignments
 * @property StudentAssignment[] $studentAssignments
 * @property Submit[] $submits
 */


class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assignment';
    }
 
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
    public function __construct($config = [])
   {
 
    parent::__construct($config);
   }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['instructorID', 'total_marks', 'yearID'], 'integer'],
            [['assName', 'assNature', 'yearID'], 'required'],
            [['finishDate'], 'safe'],
            [['course_code'], 'string', 'max' => 20],
            [['assName'], 'string', 'max' => 100],
            [['assType'], 'string', 'max' => 15],
            [['assNature', 'submitMode'], 'string', 'max' => 10],
            [['ass_desc'], 'string', 'max' => 1000],
            [['fileName'], 'string', 'max' =>70],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_code' => 'course_code']],
            [['instructorID'], 'exist', 'skipOnError' => true, 'targetClass' => Instructor::className(), 'targetAttribute' => ['instructorID' => 'instructorID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assID' => 'Ass ID',
            'instructorID' => 'Instructor ID',
            'course_code' => 'Course Code',
            'assName' => 'Assignment Name',
            'assType' => 'Assignment Type',
            'assNature' => 'Ass Nature',
            'ass_desc' => 'Assignment Description',
            'submitMode' => 'Submit Mode',
            'finishDate' => 'Finish Date',
            'total_marks' => 'Total Marks',
            'fileName' => 'File Name',
            'yearID' => 'Year ID',
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
     * Gets query for [[Assqs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssqs()
    {
        return $this->hasMany(Assq::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[GroupAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupAssignments()
    {
        return $this->hasMany(GroupAssignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[GroupAssignmentSubmits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupAssignmentSubmits()
    {
        return $this->hasMany(GroupAssignmentSubmit::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[GroupGenerationAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationAssignments()
    {
        return $this->hasMany(GroupGenerationAssignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[StudentAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentAssignments()
    {
        return $this->hasMany(StudentAssignment::className(), ['assID' => 'assID']);
    }

    /**
     * Gets query for [[Submits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubmits()
    {
        return $this->hasMany(Submit::className(), ['assID' => 'assID']);
    }
    public function getSubmitsPercent()
    {
      $submits=[];
      $assigned=0;
      $course=yii::$app->session->get('ccode');
      if($this->assType=="groups"){$submits=$this->groupAssignmentSubmits;$assigned=count($this->groupAssignments);}
      else if($this->assType=="allgroups"){
        $submits=$this->groupAssignmentSubmits;
        $gentypes=$this->groupGenerationAssignments;
        for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
      }
      else if($this->assType=="allstudents"){
        $submits=$this->submits;
        $assigned=$assigned+count(CourseStudents::getClassStudents($course));

        
      }
      else{$submits=$this->submits;$assigned=count($this->studentAssignments);}
      $subperc=0;
      if($assigned!=0)
      {
      $subperc=(count($submits)/$assigned)*100;
      }
      return $subperc;
    }
    public function getMissingAssignmentsPerc()
    {
            $submits=[];
            $assigned=0;
            $course=yii::$app->session->get('ccode');
            if($this->assType=="groups"){$submits=$this->groupAssignmentSubmits;$assigned=count($this->groupAssignments);}
            else if($this->assType=="allgroups"){
              $submits=$this->groupAssignmentSubmits;
              $gentypes=$this->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($this->assType=="allstudents"){
              $submits=$this->submits;

              $assigned=$assigned+count(CourseStudents::getClassStudents($course));
              }
            else{$submits=$this->submits;$assigned=count($this->studentAssignments);} 
            
            $missing=$assigned-count($submits);
            $missperc=0;
            if($assigned!=0)
            {
            $missperc=($missing/$assigned)*100;
            }

            return $missperc;
    }
    public function getMarkedAssignmentsPerc()
    {
            $submits=[];
            $assigned=0;
            $marked_submits=[];
            $course=yii::$app->session->get('ccode');
            if($this->assType=="groups"){$submits=$this->groupAssignmentSubmits;$assigned=count($this->groupAssignments);}
            else if($this->assType=="allgroups"){
              $submits=$this->groupAssignmentSubmits;
              $gentypes=$this->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($this->assType=="allstudents"){
              $submits=$this->submits;
              $assigned=$assigned+count(CourseStudents::getClassStudents($course));
          }
            else{$submits=$this->submits;$assigned=count($this->studentAssignments);} 
            
            for($o=0;$o<count($submits);$o++)
            {
              if($submits[$o]->isMarked()){array_push($marked_submits,$submits[$o]);}
            }
            $marked=count($marked_submits);
            $allsubmits=count($submits);
            $markperc=0;
            if($allsubmits!=0)
            {
            $markperc=($marked/$allsubmits)*100;
            }

            return $markperc;
    }
    public function getFailurePerc()
    {
            $submits=[];
            $failed_submits=[];
            $marked_submits=[];
            $assigned=0;
            $course=yii::$app->session->get('ccode');
            if($this->assType=="groups"){$submits=$this->groupAssignmentSubmits;$assigned=count($this->groupAssignments);}
            else if($this->assType=="allgroups"){
              $submits=$this->groupAssignmentSubmits;
              $gentypes=$this->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($this->assType=="allstudents"){
              $submits=$this->submits;
              $assigned=$assigned+count(CourseStudents::getClassStudents($course));
              }
            else{$submits=$this->submits;$assigned=count($this->studentAssignments);} 
            
            for($o=0;$o<count($submits);$o++)
            {
              if($submits[$o]->isMarked()){array_push($marked_submits,$submits[$o]);}
            }
            for($f=0;$f<count($submits);$f++)
            {
              if($submits[$f]->isFailed()){array_push($failed_submits,$submits[$f]);}
            }
            $marked=count($marked_submits);
            $failedsubmits=count($failed_submits);
            $failedperc=0;
            if($marked!=0)
            {
            $failedperc=$marked!=0?($failedsubmits/$marked)*100:0;
            }

            return $failedperc;
    }
    public function isExpired()
    {
      $today=date('Y-m-d H:i:s');

      return $this->finishDate<$today;
    }

    public function isNew()
    {
        date_default_timezone_set('Africa/Dar_es_Salaam');
        $time=strtotime($this->create_time);
        $lastlogin=yii::$app->user->identity->last_login;
        $lastlogin=strtotime($lastlogin);

        return $lastlogin<$time;
    }

}
