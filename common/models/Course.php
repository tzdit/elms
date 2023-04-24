<?php

namespace common\models;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $course_code
 * @property string $course_name
 * @property float $course_credit
 * @property int $course_semester
 * @property int|null $course_duration
 * @property string|null $course_status
 * @property int $departmentID
 * @property int $caw
 * @property int $sew
 * @property string $type
 * @property int $YOS
 *
 * @property Announcement[] $announcements
 * @property Assignment[] $assignments
 * @property Department $department
 * @property ExtAssess[] $extAssesses
 * @property StudentShortCourse[] studentshortcourses
 * @property GroupGenerationTypes[] $groupGenerationTypes
 * @property GroupGenerationTypes[] $groupGenerationTypes0
 * @property InstructorCourse[] $instructorCourses
 * @property LiveLecture[] $liveLectures
 * @property Material[] $materials
 * @property Module[] $modules
 * @property Notification[] $notifications
 * @property ProgramCourse[] $programCourses
 * @property StudentCourse[] $studentCourses
 * @property Student[] $regNos
 * @property ForumQnTag[] forumQnTags
 * @property Quiz[] quizzes
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }
   
    public function behaviors()
    {
        return [
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
             ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code', 'course_name', 'course_credit','caw','sew', 'course_semester', 'departmentID', 'YOS'], 'required'],
            [['course_credit'], 'number'],
            [['course_semester', 'course_duration', 'departmentID', 'YOS'], 'integer'],
            [['course_code'], 'string', 'max' => 20],
            [['course_name'], 'string', 'max' => 150],
            [['type'], 'string', 'max' => 20],
            [['course_status'], 'string', 'max' => 10],
            [['course_code'], 'unique'],
            [['type'], 'default', 'value'=>"normal"],
            [['departmentID'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departmentID' => 'departmentID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_code' => 'Course Code',
            'course_name' => 'Course Name',
            'course_credit' => 'Course Credit',
            'course_semester' => 'Course Semester',
            'course_duration' => 'Course Duration',
            'course_status' => 'Course Status',
            'departmentID' => 'Department ID',
            'YOS' => 'Yos',
        ];
    }

    /**
     * Gets query for [[Announcements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncements()
    {
        return $this->hasMany(Announcement::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Assignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['departmentID' => 'departmentID']);
    }
    public function getDepartmentdesc()
    {
        return $this->department->department_name." [".$this->department->depart_abbrev."]";
    }
    /**
     * Gets query for [[ExtAssesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtAssesses()
    {
        return $this->hasMany(ExtAssess::className(), ['course_code' => 'course_code']);
    }
    public function getStudentshortcourses()
    {
        return $this->hasMany(StudentShortCourse::className(), ['course_code' => 'course_code']);
    }

    public function getForumQnTags()
    {
        return $this->hasMany(ForumQnTag::className(), ['course_code' => 'course_code']);
    }

    public function getQuizzes()
    {
        return $this->hasMany(Quiz::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[GroupGenerationTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationTypes()
    {
        return $this->hasMany(GroupGenerationTypes::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[GroupGenerationTypes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroupGenerationTypes0()
    {
        return $this->hasMany(GroupGenerationTypes::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[InstructorCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstructorCourses()
    {
        return $this->hasMany(InstructorCourse::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[LiveLectures]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLiveLectures()
    {
        return $this->hasMany(LiveLecture::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Modules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(Module::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[ProgramCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramCourses()
    {
        return $this->hasMany(ProgramCourse::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[StudentCourses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[RegNos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegNos()
    {
        return $this->hasMany(Student::className(), ['reg_no' => 'reg_no'])->viaTable('student_course', ['course_code' => 'course_code']);
    }

    public function NewAnnouncemntsCount()
    {
        $announcements=$this->announcements;

        foreach($announcements as $key=>$announcement)
        {
            if(!$announcement->isNew())
            {
              unset($announcements[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($announcements);
    }

    public function newQuizesCount()
    {
        $quizes=$this->quizzes;

        foreach($quizes as $key=>$quiz)
        {
            if(!$quiz->isNew())
            {
              unset($quizes[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($quizes);
    }

    public function newAssignmentsCount()
    {
        $assignments=$this->assignments;

        foreach($assignments as $key=>$assignment)
        {
            if(!$assignment->isNew())
            {
              unset($assignments[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($assignments); 
    }

    
    public function newGroupAssignmentsCount()
    {
        $assignments=$this->assignments;

        foreach($assignments as $key=>$assignment)
        {
            if(!$assignment->isNew() || ($assignment->assType!="allgroups" && $assignment->assType!="groups" ))
            {
              unset($assignments[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($assignments); 
    }

    public function newIndividualAssignmentsCount()
    {
        $assignments=$this->assignments;

        foreach($assignments as $key=>$assignment)
        {
            if(!$assignment->isNew() || ($assignment->assType!="allstudents" && $assignment->assType!="students" ))
            {
              unset($assignments[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($assignments); 
    }

    public function newtutorialsCount()
    {
        $assignments=$this->assignments;

        foreach($assignments as $key=>$assignment)
        {
            if(!$assignment->isNew() || $assignment->assNature!="tutorial")
            {
              unset($assignments[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($assignments); 
    }

    public function newLecturesCount()
    {
        $lectures=$this->liveLectures;

        foreach($lectures as $key=>$lecture)
        {
            if(!$lecture->isNew())
            {
              unset($lectures[$key]);
              continue;
            }
            else
            {
                continue;
            }
        }

        return count($lectures); 
    }

    public function newMaterialsCount()
    {
        $modules=$this->modules;
        $materialscount=0;
        foreach($modules as $key=>$module)
        {
            $materials=$module->materials;

            foreach($materials as $material)
            {
            if($material->isNew())
            {
              $materialscount++;
              continue;
            }
            else
            {
                continue;
            }
            }
        }

        return $materialscount;
}
public function newGroupsCount()
{
    $groupgens=$this->groupGenerationTypes;
    $student=yii::$app->user->identity->student->reg_no;
    $groupscount=0;
    foreach( $groupgens as $genkey=>$groupgen)
    {
 
     $groups=$groupgen->groups;
    foreach($groups as $key=>$group)
    {
        if(!$group->isMember($student))
        {
          continue;
        }
        else
        {
            foreach($group->studentGroups as $gkey=>$studentGroup)
            {
                if(!$studentGroup->isNew() || $studentGroup->reg_no!=$student)
                {
                    continue;
                }
                else
                {
                    $groupscount++;
                }
            }
            
           
        }
    }
  }

    return $groupscount; 
}

public function NewExtAssessCount()
{
    $assessments=$this->extAssesses;

    foreach($assessments as $key=>$assessment)
    {
        if(!$assessment->isNew())
        {
          unset($assessments[$key]);
          continue;
        }
        else
        {
            continue;
        }
    }

    return count($assessments);
}

public function newInForumCount()
{
    $forumTags=$this->forumQnTags;
    $fcount=0;
    foreach($forumTags as $key=>$forumTag)
    {
        $question=$forumTag->question;

        if($question->isNew())
        {
          $fcount++;
          $fcount+=$question->newComments()+$question->newAnswers();

          $questionAnswers=$question->forumAnswers;
  
          foreach($questionAnswers as $key=>$questionAnswer)
          {
              $fcount+=$questionAnswer->newComments();
          }

          continue;
        }

        $fcount+=$question->newComments()+$question->newAnswers();

        $questionAnswers=$question->forumAnswers;

        foreach($questionAnswers as $key=>$questionAnswer)
        {
            $fcount+=$questionAnswer->newComments();
        }
    }

    return $fcount;
}

    public function getNewsCount()
    {
        return $this->NewAnnouncemntsCount()+$this->newAssignmentsCount()+$this->newMaterialsCount()+$this->newLecturesCount()+$this->newGroupsCount()+$this->NewExtAssessCount()+$this->newInForumCount()+$this->newQuizesCount();
    }

    public function isShort()
    {
      return $this->type=="short_course";
    }
}
