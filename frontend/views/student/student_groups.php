<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Student;
use common\models\StudentGroup;
use frontend\models\ClassRoomSecurity;
use frontend\models\GroupAssSubmit;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\GroupAssignmentSubmit;


/* @var $this yii\web\View */
$this->params['courseTitle'] = '<img src="/img/groupass.png" height="25px" width="25px"/> '.$cid." Group Assignments";
$this->title = 'Groups';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
    ['label'=>$this->title]
];


$regno=yii::$app->user->identity->student->reg_no;

?>



<!--                                                    --><?php
//                                                    echo '<pre>';
//                                                    var_dump($studentGroupsList);
//                                                    echo '</pre>';
////                                                                                             exit;
//                                                    ?>


<div class="site-index responsivetext" >
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">

          
               
                       <div class="row">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-forum" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="true"><i class="fa fa-upload text-info"></i> Submit Assignment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" id="custom-tabs-materials" data-toggle="tab" href="#materials" role="tab" aria-controls="materials" aria-selected="false"><i class="fa fa-exclamation-triangle "></i> Missing Groups</a>
                                    </li>
                                </ul>
</div>
                          

                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                                    
                                            <div class="tab-content" id="custom-tabs-four-tabContent">


                                                <!-- ########################################### group by  instructor ######################################## -->

                                                <!-- Left col -->
                                                <section class="col-lg-12 p-0">


                                                        <div class="card-body p-1 m-1 pt-3" >
                                                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                                                <?php
                                                                if(empty($studentGroupsList)){
                                                                    echo "<p class='text-muted text-lg text-center p-1 responsivetext'>";
                                                                    echo "<i class='fa fa-info-circle text-info'></i> No group found";
                                                                    echo "</p>";
                                                                }
                                                                ?>

                                                                <!-- ########################################### GROUPS ######################################## -->

                                                                <div class="accordion" id="accordionExample_3">
                                                                    <?php foreach( $studentGroupsList as $item ) : ?>
                                                        
                                                                            <div class="card shadow-lg" data-toggle="collapse" data-target="#collapse<?=$count?>" aria-expanded="true" aria-controls="collapse<?=$count?>">
                                                                                <div class="card-header p-2" id="heading<?=$count?>">
                                                                                    <h2 class="mb-0">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-8">
                                                                                                <button class="btn btn-link btn-block text-left " type="button" >
                                                                                                    <h4 class="responsiveheader"><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header "><?php echo $item['generation_type']." ";?><span class="font-italic text-info text-sm font-weight-normal "><?php echo "(".$item['groupName'].")"; ?></span></span></h4>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="col-sm-4">

                                                                                                <?php

                                                                                                $group = Groups::findOne($item['groupID']);

                                                                                                ?>

                                                                                                <?php if($group->isCreator($regno)): ?>
                                                                                                    <h5 class="text-danger" data-toggle="tooltip" data-title="Delete group"><a href="#" class="btn-delete-group float-right mr-2 mt-3" id = "btn-delete-group" groupID = "<?= $item['groupID'] ?>" ><i class="fas fa-times-circle fa-lg carry-delete"></i></a></h5>
                                                                                                    <?php else: ?>
                                                                                                        <h5 class="text-primary" data-toggle="tooltip" data-title="Exit group"><a href="#" class="exitgroup float-right mr-2 mt-3" groupID = "<?= $item['groupID'] ?>" ><i class="fa fa-sign-out-alt fa-lg "></i></a></h5>
                                                                                                <?php endif; ?>
                                                                                                 </div>
                                                                                        </div>
                                                                                    </h2>
                                                                                </div>

                                                                                <div id="collapse<?=$count?>" class="collapse" aria-labelledby="heading<?=$count?>" data-parent="#accordionExample_3">

                                                                                    <?php
                                                                                    $assignments = GroupAssignment::find()->select('assignment.*,group_assignment.groupID')
                                                                                        ->join('INNER JOIN', 'assignment', 'group_assignment.assID = assignment.assID')
                                                                                        ->where('group_assignment.groupID = :groupID',[':groupID' => $item['groupID']])->asArray()->all();

                                                                                    $assignmentAllItems = GroupGenerationAssignment::find()->select('assignment.*,group_generation_assignment.assID,groups.groupID')
                                                                                        ->join('INNER JOIN', 'group_generation_types', 'group_generation_assignment.gentypeID = group_generation_types.typeID')
                                                                                        ->join('INNER JOIN', 'groups', 'group_generation_types.typeID = groups.generation_type')
                                                                                        ->join('INNER JOIN', 'assignment', 'group_generation_assignment.assID = assignment.assID')
                                                                                        ->where('groups.groupID = :groupID',[':groupID' => $item['groupID']])->asArray()->all();


                                                                                        if(empty($assignments) && empty($assignmentAllItems))
                                                                                        {

                                                                                        

                                                                                    ?>
                                                                                      <div class="card-footer p-2 bg-white border-top">
                                                                                            <h6 class="text-danger float-right mr-4 responsivetext"><i class="fa fa-info-circle text-info"></i> No Assignments provided yet</h6>
                                                                                        </div>

                                                                                        <?php

                                                                                 
                                                                                        }

                                                                                    ?>
                                                                                 
<!--displaying assignment-->
                                                                                    <?php if (!empty($assignments)): ?>

                                                                                        <?php foreach ($assignments as $assignment ): ?>
                                                                                                        <?php
                                                                                                        //variable to check if there is any submission
                                                                                                        $submited = GroupAssSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $assignment['groupID'],':assID' => $assignment['assID']])->asArray()->one();
                                                                                                        ?>
                                                                                            <div class="card-footer p-2 material-background mt-3 border-top border-bottom">
                                                                                            <?php
                                                                                                      if($submited!=null):
                                                                                                      if(!GroupAssignmentSubmit::findOne($submited['submitID'])->isSigned()):
                                                                                                    ?>
                                                                                                    <span class="text-danger float-right"><i class="fa fa-exclamation-triangle"></i> Not signed </span>
                                                                                                    <?php
                                                                                                    else:
                                                                                                    ?>
                                                                                                     <span class="text-success float-right" ><i class="fa fa-check"></i> Signed </span>

                                                                                                    <?php
                                                                                                    endif;
                                                                                                    endif

                                                                                                    ?>
                                                                                                <div class="card-header border-0">
                                                                                                  
                                                                                                     
                                                                                                    <p class="card-text ml-2"><span style="color:green">Assignment: </span>  <?= Html::encode(ucwords($assignment['assName'])) ?> </p>
                                                                                                    
                                                                                                    <p class="card-text ml-2"><span style="color:green"> Description: </span>  <?= Html::encode(ucwords($assignment['ass_desc'])) ?> </p>
                                                                                                    <p class="card-text ml-2"><span style="color:green"> Type: </span>  <?= ($assignment['assNature']=="lab")?"Lab":"Normal" ?> </p>

                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 text-sm">
                                                                                                  



                                                                                                        <?php
                                                                                                            date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                                                            // check if deadline of submit assignment is met
                                                                                                            $currentDateTime = new DateTime("now");
                                                                                                            //set an date and time to work with
                                                                                                            $start = $assignment['finishDate'];
                                                                                            
                                                                                                            $deadLineDate = new DateTime($start);
                                                                                                            $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                                                        ?>



                                                                                                        <b class="text-danger ml-4"><i class="fa fa-clock-o ml-2"></i> Deadline : </b><span class="responsivetext"><?= $deadLineDate->format('d-m-Y H:i:s A') ?> </span>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">

                                                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assignment['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>


                                                                                                        <?php if($isOutOfDeadline == true){?>
                                                                                                            <button class="btn btn-default text-danger float-right" disabled><i class="fas fa-ban">Expired</i> </button>
                                                                                      <?php }else{?>
                                                                                        <?php if($submited==null){?>
                                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> ClassRoomSecurity::encrypt($assignment['assID']), 'groupID' => ClassRoomSecurity::encrypt($assignment['groupID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                      <?php }else{ ?>
  
                                                                                        <?php if($assignment['submitMode'] == "unresubmit"){?>
                                                                                        <button class="btn btn-sm btn-default float-right text-danger ml-2"><i class="fa  fa-ban"> Already Submitted</i></button>
                                                                                              <?php }else{ ?>
                                                                    
                                                                                                <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> ClassRoomSecurity::encrypt($assignment['assID']), 'submit_id' => ClassRoomSecurity::encrypt($submited['submitID']), 'groupID' => ClassRoomSecurity::encrypt($assignment['groupID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                      <?php } ?>
                                                                                      <?php

                                                                                      if(!GroupAssignmentSubmit::findOne($submited['submitID'])->isSigned()):
                                                                                      ?>
                                                                                      <a href="<?= Url::toRoute(['/student/sign-submit', 'submit' => ClassRoomSecurity::encrypt($submited['submitID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fa fa-check"> Sign</i></span></a>
                                                                                      <?php
                                                                                        endif
                                                                                      ?>
                                                                                        <?php } ?>
                                                                                        <?php } ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endforeach;endif?>


                                                                                                                                     
                                                                                                  


                 
                                                                                    <?php if (!empty($assignmentAllItems)): ?>

                                                                                        <?php foreach ($assignmentAllItems as $assignmentAllItem ): ?>
                                                                                            <?php
                                                                                                        //variable to check if there is any submission
                                                                                                        $submitedAll = GroupAssSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $assignmentAllItem['groupID'],':assID' => $assignmentAllItem['assID']])->asArray()->one();
                                                                                                        ?>

                                                                                            <div class=" card-footer p-2 material-background mt-3 border-top border-bottom">
                                                                                            <?php
                                                                                                     if($submitedAll!=null):
                                                                                                      if(!GroupAssignmentSubmit::findOne($submitedAll['submitID'])->isSigned()):
                                                                                                    ?>
                                                                                                    <span class="text-danger float-right"><i class="fa fa-exclamation-triangle"></i> Not signed </span>
                                                                                                    <?php
                                                                                                    else:
                                                                                                    ?>
                                                                                                     <span class="text-success float-right" ><i class="fa fa-check"></i> Signed </span>

                                                                                                    <?php
                                                                                                    endif;
                                                                                                    endif

                                                                                                    ?>
                                                          
                                                                                                <div class="card-header border-0">
                                                                        
                                                                                                    <p class="card-text ml-2"><span style="color:green"> Assignment: </span>  <?= ucwords($assignmentAllItem['assName'])?> </p>
                                                                                                    <p class="card-text ml-2"><span style="color:green"> Description: </span>  <?= $assignmentAllItem['ass_desc'] ?> </p>
                                                                                                    <p class="card-text ml-2"><span style="color:green"> Type: </span>  <?= ($assignmentAllItem['assNature']=="lab")?"Lab":"Normal" ?> </p>
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6 text-sm">
                                                                                                      



                                                                                                        <?php
                                                                                                                date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                                                                // check if deadline of submit assignment is met
                                                                                                                $currentDateTime = new DateTime("now");
                                                                                                                //set an date and time to work with
                                                                                                                $start =$assignmentAllItem['finishDate'];
                                                                                                
                                                                                                                $deadLineDate = new DateTime($start);
                                                                                                                $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                                                        ?>


                                                                                                        <b class="text-danger ml-4"><i class="fa fa-clock-o ml-2"></i> Deadline : </b><span class="responsivetext"><?= $deadLineDate->format('d-m-Y H:i:s A') ?> </span>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">

                                                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                                                       

                                                                                                        <?php if($isOutOfDeadline == true){?>
                                                                                                            <button class="btn btn-default text-danger float-right" disabled><i class="fas fa-ban">Expired</i> </button>
                                                                                      <?php }else{?>
                                                                                        <?php if($submitedAll==null){?>
                                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID']), 'groupID' => ClassRoomSecurity::encrypt($assignmentAllItem['groupID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                      <?php }else{ ?>
  
                                                                                        <?php if($assignmentAllItem['submitMode'] == "unresubmit"){?>
                                                                                        <button class="btn btn-sm btn-default float-right text-danger ml-2"><i class="fa  fa-ban"> Already Submitted</i></button>
                                                                                              <?php }else{ ?>
                                                                                                <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID']), 'submit_id' => ClassRoomSecurity::encrypt($submitedAll['submitID']), 'groupID' => ClassRoomSecurity::encrypt($assignmentAllItem['groupID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                      <?php } ?>
                                                                                      <?php

                                                                                            if(!GroupAssignmentSubmit::findOne($submitedAll['submitID'])->isSigned()):
                                                                                            ?>
                                                                                            <a href="<?= Url::toRoute(['/student/sign-submit', 'submit' => ClassRoomSecurity::encrypt($submitedAll['submitID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fa fa-check"> Sign</i></span></a>
                                                                                            <?php
                                                                                            endif
                                                                                            ?>


                                                                                        <?php } ?>
                                                                                        <?php } ?>
                                                                      

                                                                                                        
                                                                                                    </div>
                                                                                                </div>
                                                                                                </div>
                                                                                            

                                                                                        <?php endforeach; endif;?>
                                                                                
                                                                                        <!--end of displaying assignment--> 
                                                                                    <?php
                                                                                    $studentList = StudentGroup::find()->select('student.fname, student.mname, student.lname, student.reg_no, student.programCode, student.phone ')->join('INNER JOIN', 'student', 'student.reg_no = student_group.reg_no')->where('groupID = :groupID ', [':groupID' => $item['groupID']])->asArray()->all();
                                                                                    ?>
                                                                                    <div class="p-5">
                                                                                        <div class="row bg-primary p-2">
                                                                                            Group Members
                                                                                        </div>
                                                                                        <!-- -----------------------------group members ---------------------------------------->
                                                                                        <?php foreach ($studentList as $student) : ?>
                                                                                            <div class="text-sm row p-1 bg-white shadow-lg responsivetext">
                                                                                                <div class="p-1 col-sm text-muted" ><?=ucfirst(strtolower($student['fname'])) ?> </div> <div class="p-1 col-sm text-muted" ><?= ucfirst(strtolower($student['mname'])) ?> </div><div class="p-1 col-sm text-muted" > <?= ucfirst(strtolower($student['lname'])) ?> </div><div class="p-1 col-sm text-muted" > <?= $student['reg_no'] ?> </div><div class="p-1 col-sm text-muted" ><?= $student['programCode'] ?> </div><div class="p-1 col-sm text-muted" > <?= $student['phone'] ?> </div>
                                                                                            </div>
                                                                                        <?php endforeach; ?>
                                                                                    </div>
                                                                                   
                                                                                   
                                                                                </div>

                                                                            </div>
                                                                            <?php
                                                                            $count--;
                                                                            ?>
                                                                      
                                                                       
                                                                    <?php endforeach; ?>
                                                                   
                                                            </div>
                                                            <!-- ########################################### GROUPS END ######################################## -->
                                                        </div>
                                                        
                                                        </div>                  

                                                </section>
                                                <!-- ########################################### group by instructor end ######################################## -->
                                            </div>
                                       
                                    </div>
                 
                                    <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-materials">
                                        <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                                            
                                                <div class="tab-content pt-4" id="custom-tabs-four-tabContent">


                                                    <!-- ########################################### group by student ######################################## -->

                                                    <!-- Left col -->
                                                    <section class="col-lg-12">





                                               



                                                 



                                                                                                   


                                                        <div class="accordion" id="accordionExample_33">
                                                  

                                                       
                                                    
                                                            <?php 
                                                            $countmissing=0;
                                                            foreach( $noGroupAssignment as $itemNoGroup ) { ?>


                                                                 <?php

                                                                    $checkGroup = Groups::find()->join('INNER JOIN','student_group','groups.groupID = student_group.groupID')->where('groups.generation_type = :typeID AND student_group.reg_no = :reg_no', [':typeID' => $itemNoGroup['typeID'], ':reg_no' => $reg_no])->count();
                                                                    $studentlist=ArrayHelper::map(Student::find()->
                                                                    select(['student.reg_no', 'student.fname', 'student.mname', 'student.lname'])
                                                                        ->join('INNER JOIN', 'program', 'student.programCode = program.programCode')
                                                                        ->join('INNER JOIN', 'program_course', 'program.programCode = program_course.programCode')
                                                                        ->join('LEFT OUTER JOIN', 'student_group', 'student.reg_no = student_group.reg_no')
                                                                        ->join('LEFT OUTER JOIN', 'groups', 'student_group.groupID = groups.groupID')
                                                                        ->where('(groups.generation_type != :generation_type OR groups.generation_type IS NULL )  AND program_course.course_code = :course_code AND student.reg_no != :reg_no', [':generation_type' => $itemNoGroup['typeID'], ':course_code' => $itemNoGroup['course_code'], ':reg_no' => Yii::$app->user->identity->username])
                                                                        ->orderBy(['student.fname' => SORT_ASC])
                                                                        ->asArray()
                                                                        ->all(),'reg_no',
                                                                        function ($model){
                                                                        return $model['fname']." ".$model['mname']." ".$model['lname']." - ".$model['reg_no'];
                                                                        }
                                                                    );
                                                                ?>

                                                                <?php if ($checkGroup == 0){
                                                                    $countmissing++;
                                                                     ?>
                                                                <div class="card ">
                                                                    <div class="card shadow-lg">
                                                                        <div class="card-header p-2" id="heading<?=$noGroupAssignmentCount?>">
                                                                            <h2 class="mb-0">
                                                                                <div class="row">
                                                                                    <div class="col-sm-11">
                                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" >

                                                                                            <div class="row">
                                                                                                <div class="col-sm-6">
                                                                                                    <h4><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header responsiveheader "><?php echo $itemNoGroup['generation_type']." ";?></span></h4>
                                                                                                    <h6 class="responsivetext"><span>Assignment Name: </span><span class="assignment-header "><?php echo $itemNoGroup['assName']." ";?></span></h6>
                                                                                                </div>
                                                                                                <div class="col-sm-4 responsivetext">
                                                                                                    <div class="responsivetext"><i class="fa fa-exclamation-triangle text-danger"></i><h6 class="text-danger responsivetext">You do not belong to any group in this assignment !</h6></div>
                                                                                                    <h4 class="btn btn-default btn-sm shadow d-none d-md-block text-primary" data-toggle="collapse" data-target="#collapse<?=$noGroupAssignmentCount?>" aria-expanded="true" aria-controls="collapse<?=$noGroupAssignmentCount?>"><i class="fa fa-plus-circle"></i>Create Group</h4>
                                                                                                </div>
                                                                                            </div>

                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </h2>
                                                                        </div>

                                                                    </div>

                                                                    <div id="collapse<?=$noGroupAssignmentCount?>" class="collapse" aria-labelledby="heading<?=$noGroupAssignmentCount?>" data-parent="#accordionExample_33">


                                                                        <div class="card mx-3 p-4  form-group">

                                                                            <div class="mb-2 text-center">
                                                                                <h5 class="text-primary text-sm responsivetext"><i class="fa fa-info-circle"></i> You will automatically be added to the group you create</h5>
                                                                            </div>
                                                                            <div class="container pl-5 pr-5 text-sm text-primary">
                                                                            <?php 
                                                                           
                                                                            $form = ActiveForm::begin();
                                                                            ?>

                                                                            
                                                                            <?= $form->field($model, 'groupName')->textInput(['class' => 'form-control form-control-sm', 'placeholder'=>'Ex: Group 1, Group one'])->label('Group Name') ?>
                                                                            <?php
                                                                        
                                                                            echo $form->field($model,'memberStudents[]')->dropDownList($studentlist,['data-placeholder'=>'-- Search for members --','class' => 'form-control','id' => 'group_members'.$noGroupAssignmentCount, 'multiple'=>true,'style'=>"width:100%"])->label('Group Members') ;


                                                                            ?>

                                                                            <?=  $form->field($model, 'generation_type')->hiddenInput(['value' => $itemNoGroup['typeID']])->label(false) ?>


                                                                            <div class="form-group">
                                                                                <?= Html::submitButton(Yii::t('app', '<i class="fa fa-plus-circle"></i> Create'), ['class' => 'btn btn-primary float-right']) ?>
                                                                            </div>

                                                                            <?php ActiveForm::end(); ?>
                                                                            </div>
                                                                            <?php
                                                                            $script = <<<JS
                                                                            $(document).ready(function(){
                                                                            $('#group_members' + $noGroupAssignmentCount).select2();
                                                                            
                                                                            });
                                                                            JS;

                                                                            $this->registerJs($script);

                                                                            ?>


                                                                        </div>


                                                                    </div>

                                                                    </div>
                                                                <?php } ?>

                                                                <?php
                                                                $noGroupAssignmentCount--;
                                                                ?>

                                                            <?php } ?>

                                                            <?php if($countmissing==0)
                                                            {
                                                            ?>
                                                             <span class="text-center"><i class="fa fa-info-circle text-info"></i> No Assignments Missing Groups</div>

                                                                <?php
                                                            }
                                                            ?>
                                                        </div>

                                                    </section>
                                                    <!-- ########################################### group by student end ######################################## -->
                                             
                                            </div>
                                        </div>
                                    </div>
                                </div>

                  
           
        </div>
    </div><!--/. container-fluid -->
</div>




