<?php
    
    namespace ruturajmaniyar\mod\audit\behaviors;
    
    use ruturajmaniyar\mod\audit\models\AuditEntry;
    use Yii;
    use yii\base\Behavior;
    use yii\base\Exception;
    use yii\db\ActiveRecord;
    use yii\db\Expression;
    
    /**
     * Class AuditEntryBehaviour
     *
     * @package ruturajmaniyar\mod\audit\behaviours
     */
    class AuditEntryBehaviors extends Behavior
    {
        /**
         * string
         */
        const NO_USER_ID = "NO_USER_ID";
        public $newornot;
        /**
         * @param $class
         * @param $attribute
         *
         * @return string
         */
        public static function getLabel($class, $attribute)
        {
            $labels = $class::attributeLabels();
            if (isset($labels[$attribute])) {
                return $labels[$attribute];
            } else {
                return ucwords(str_replace('_', ' ', $attribute));
            }
        }
        
        /**
         * @return array
         */
        public function events()
        {
            return [
                ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
                ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
                ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
                ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
                ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ];
        }
        
        /**
         * @param      $event
         *
         * @param null $attributes
         *
         * @return mixed
         */
        public function beforeSave($event)
        {
            $this->newornot=$this->owner->isNewRecord;
        }
        public function afterSave($event, $attributes = null)
        {
            try {
                $userId = Yii::$app->user->identity->getId();
                $userIpAddress = Yii::$app->request->getUserIP();
                
            } catch (Exception $e) {
                $userId = self::NO_USER_ID;
            }
            
            $newAttributes = $this->owner->getAttributes();
            $oldAttributes = $event->changedAttributes;
            
            $action = Yii::$app->controller->action->id;
            if (!$this->newornot) {
                // compare old and new
                foreach ($oldAttributes as $name => $oldValue) {
                    if (!empty($newAttributes)) {
                        $newValue = $newAttributes[$name];
                    } else {
                        $newValue = 'NA';
                    }
                    if ($oldValue != $newValue) {
                        $log = new AuditEntry();
                        $log->audit_entry_old_value = $oldValue;
                        $log->audit_entry_new_value = $newValue;
                        $log->audit_entry_operation = 'UPDATE';
                        $log->audit_entry_affected_record_reference=strval($this->owner->getPrimaryKey());
                        $log->audit_entry_affected_record_reference_type=($this->owner)::className();
                        $log->audit_entry_model_name = substr(get_class($this->owner), strrpos(get_class($this->owner), '\\') + 1);
                        $log->audit_entry_field_name = $name;
                        $log->audit_entry_timestamp = new Expression('unix_timestamp(NOW())');
                        $log->audit_entry_user_id = $userId;
                        $log->audit_entry_ip = $userIpAddress;
                        
                        $log->save(false);
                    }
                }
            } else {
                foreach ($newAttributes as $name => $value) {
                    $log = new AuditEntry();
                    $log->audit_entry_old_value = 'NA';
                    $log->audit_entry_new_value = $value;
                    $log->audit_entry_operation = 'INSERT';
                    $log->audit_entry_affected_record_reference='N/A';
                    $log->audit_entry_affected_record_reference_type='N/A';
                    $log->audit_entry_model_name = substr(get_class($this->owner), strrpos(get_class($this->owner), '\\') + 1);
                    $log->audit_entry_field_name = $name;
                    $log->audit_entry_timestamp = new Expression('unix_timestamp(NOW())');
                    $log->audit_entry_user_id = $userId;
                    $log->audit_entry_ip = $userIpAddress;
                    
                    $log->save(false);
                }
            }
            return true;
        }
        
        /**
         * This function is fo save data to Audit Trail after the delete action.
         *
         * @return bool
         */
        public function afterDelete()
        {
            
            try {
                $userId = Yii::$app->user->identity->getId();
                $userIpAddress = Yii::$app->request->getUserIP();
                
            } catch (Exception $e) { //If we have no user object, this must be a command line program
                $userId = self::NO_USER_ID;
            }
            
            
            $reference=$this->getOperationReference($this->owner);
            foreach($reference as $referencetype=>$reference)
            {
            $log = new AuditEntry();
            $log->audit_entry_old_value = 'N/A';
            $log->audit_entry_new_value = 'N/A';
            $log->audit_entry_operation = 'DELETE';
            $log->audit_entry_affected_record_reference=strval($reference);
            $log->audit_entry_affected_record_reference_type=strval($referencetype);
            $log->audit_entry_model_name = substr(get_class($this->owner), strrpos(get_class($this->owner), '\\') + 1);
            $log->audit_entry_field_name = 'N/A';
            $log->audit_entry_timestamp = new Expression('unix_timestamp(NOW())');
            $log->audit_entry_user_id = $userId;
            $log->audit_entry_ip = $userIpAddress;
            
            $log->save(false);
            }
      
            return true;
        }
        
        public function getOperationReference($owner)
        {
          $classname=$owner::ClassName();

          //trying to find a good reference basic on the type
          //of affected db object

          switch($classname)
          {
              case "common\models\Academicyear":
                 
                 return ['Academic Year'=>$owner->title];
                    break;
              case "common\models\Admin":
                return ['Admin'=>$owner->adminID,'User'=>$owner->userID];    
                    break;
              case "common\models\Announcement":
                return ['Course'=>$owner->course_code,'Title'=>$owner->title];
                    break;
              case "common\models\Assignment":
                return ['course'=>$owner->course_code];
                    break;
              case "common\models\Assq":
                return ['Assignment'=>$owner->assID,'Course'=>$owner->course_code];    
                    break;
    
              case "common\models\College":
                    return ['college name'=>$owner->college_abbrev];
                    break;
              case "common\models\Course":
                    return ['Course'=>$owner->course_code];
                    break;
              case "common\models\Department":
                    return ['Department'=>$owner->depart_abbrev];
                    break;
              case "common\models\ExtAssess":
                    return ['Course'=>$owner->course_code,'Title'=>$owner->title];
                    break;
              case "common\models\GroupAssignment":
                    return ['Assignment'=>$owner->assID,'Group'=>$owner->groupID];
                    break;
              case "common\models\GroupAssignentSubmit":
                    return ['Assignment'=>$owner->assID,'Group'=>$owner->groupID];
                    break;
              case "common\models\GroupGenerationAssignment":
                    return ['Assignment'=>$owner->assID,'Groups Generation'=>$owner->gentypeID];
                    break;
              case "common\models\GroupGenerationTypes":
                    return ['Course'=>$owner->course_code,'Generation title'=>$owner->generation_type];
                        break;
              case "common\models\Groups":
                    return ['Groups Generation'=>$owner->generation_type,'Course'=>$owner->course_code];
                        break;
              case "common\models\Instructor":
                    return ['Instructor'=>$owner->instructorID,'User'=>$owner->userID];
                        break;
              case "common\models\InstructorCourse":
                    return ['Instructor'=>$owner->instructorID,'Course'=>$owner->course_code]; 
                    break;
              case "common\models\Lectureroominfo":
                    return ['Lecture'=>$owner->lectureID];
                    break;
              case "common\models\LiveLecture":
                    return ['Course'=>$owner->course_code,'Lecture'=>$owner->title];
                    break;
              case "common\models\Material":
                    return ['Module'=>$owner->moduleID,'Material title'=>$owner->title];
                    break;
              case "common\models\Module":
                    return ['Course'=>$owner->course_code,'Module name'=>$owner->moduleName];
                    break;
              case "common\models\Program":
                    return ['Program'=>$owner->programCode];
                    break;
              case "common\models\ProgramCourse":
                    return ['Program'=>$owner->programCode,'Course'=>$owner->course_code];
                    break;
              case "common\models\QMarks":
                    return ['Submit'=>($owner->submitID!==null)?$owner->submitID:$owner->group_submit_id];
                    break;
              case "common\models\Quiz":
                    return ['lecture'=>$owner->lectureID];
                    break;
              case "common\models\Student":
                    return ['Student'=>$owner->reg_no,'User'=>$owner->userID];
                    break;
              case "common\models\StudentAssignment":
                    return ['Assignment'=>$owner->assID,'Student'=>$owner->reg_no];
                    break;
              case "common\models\StudentCourse":
                    return ['Course'=>$owner->course_code,'Student'=>$owner->reg_no];
                    break;
              case "common\models\StudentExtAssess":
                    return ['Student'=>$owner->reg_no,'External Assessments'=>$owner->assessID];
                    break;
              case "common\models\StudentGroup":
                    return ['Student'=>$owner->reg_no,'group'=>$owner->groupID];
                    break;
              case "common\models\StudentLecture":
                    return ['Student'=>$owner->reg_no,'lecture'=>$owner->lectureID];
                    break;
              case "common\models\StudentQuiz":
                    return ['Student'=>$owner->reg_no,'quiz'=>$owner->quizID];
                    break;
              case "common\models\Submit":
                    return ['student'=>$owner->reg_no,'assignment'=>$owner->assID];
                    break;
              case "common\models\User":
                     return $owner->username;
                    break;
              default:
                    return ['N/A'=>'N/A'];      

                    break;
          }
        }
    }