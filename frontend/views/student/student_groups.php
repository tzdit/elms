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
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;


/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid." - Group Assignment";
$this->title = 'Groups';
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];

?>



<!--                                                    --><?php
//                                                    echo '<pre>';
//                                                    var_dump($studentGroupsList);
//                                                    echo '</pre>';
////                                                                                             exit;
//                                                    ?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">

            <div class="row">
                <section class="col-lg-12">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-forum" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="true"><img src="<?= Yii::getAlias('@web/img/upload.png') ?>" width="30" height="30" class=" mr-2">GROUP ASSIGNMENT FOR SUBMISSION</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-materials" data-toggle="tab" href="#materials" role="tab" aria-controls="materials" aria-selected="false"><img src="<?= Yii::getAlias('@web/img/create.png') ?>" width="30" height="30" class=" mr-2">CREATE GROUP FOR ASSIGNMENT</a>
                                    </li>
                                </ul>

                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                                        <div class="card-body" >
                                            <div class="tab-content" id="custom-tabs-four-tabContent">


                                                <!-- ########################################### group by  instructor ######################################## -->

                                                <!-- Left col -->
                                                <section class="col-lg-12">


                                                        <div class="card-body" >
                                                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                                                <?php
                                                                if(empty($studentGroupsList)){
                                                                    echo "<p class='text-muted text-lg'>";
                                                                    echo "No group found";
                                                                    echo "</p>";
                                                                }
                                                                ?>

                                                                <!-- ########################################### GROUPS ######################################## -->

                                                                <div class="accordion" id="accordionExample_3">
                                                                    <?php foreach( $studentGroupsList as $item ) : ?>
                                                                        <div class="card">
                                                                            <div class="card shadow-lg">
                                                                                <div class="card-header p-2" id="heading<?=$count?>">
                                                                                    <h2 class="mb-0">
                                                                                        <div class="row">
                                                                                            <div class="col-sm-8">
                                                                                                <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$count?>" aria-expanded="true" aria-controls="collapse<?=$count?>">
                                                                                                    <h4><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header "><?php echo $item['generation_type']." ";?><span class="font-italic text-info font-weight-normal"><?php echo "(".$item['groupName'].")"; ?></span></span></h4>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="col-sm-4">

                                                                                                <?php

                                                                                                $groupCreator = Groups::find()->select('group_generation_types.creator_type')->join('INNER JOIN', 'group_generation_types', 'groups.generation_type = group_generation_types.typeID')->where('groups.groupID = :groupID', [':groupID' => $item['groupID']])->asArray()->one();

                                                                                                ?>

                                                                                                <?php if ($groupCreator['creator_type'] == 'instructor-student'): ?>
                                                                                                    <h4 class="text-danger"><a href="#" class="btn-delete-group float-right mr-2" id = "btn-delete-group" groupID = "<?= $item['groupID'] ?>" ><i class="fas fa-times-circle fa-lg carry-delete"></i></a></h4>
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

                                                                                    ?>

                                                                                    <!--                                                    --><?php
                                                                                    //                                                    echo '<pre>';
                                                                                    //                                                    var_dump($assignmentAllItems);
                                                                                    //                                                    echo '</pre>';
                                                                                    ////                                                                                             exit;
                                                                                    //                                                    ?>
<!--displaying assignment-->
                                                                                    <?php if (!empty($assignments)): ?>

                                                                                        <?php foreach ($assignments as $assignment ): ?>

                                                                                            <div class="card-footer p-2 material-background mt-3 border-top border-bottom">
                                                                                                <div class="card-header border-0">
                                                                                                    <h5 class="ml-3"><i class="fas fa-clipboard-list"></i> <span class="assignment-header"><?php  echo ucwords($assignment['assName'])?></span></h5>
                                                                                                    <p class="card-text ml-5"><span style="color:green"> Description: </span>  <?= $assignment['ass_desc'] ?> </p>

                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <?php
                                                                                                        //variable to check if there is any submission
                                                                                                        $submited = GroupAssSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $assignment['groupID'],':assID' => $assignment['assID']])->asArray()->one();
                                                                                                        ?>



                                                                                                        <?php
                                                                                                        // check if dead line of submit assignment is meet
                                                                                                        $currentDateTime = new DateTime("now");
                                                                                                        //set an date and time to work with
                                                                                                        $start = $assignment['finishDate'];

                                                                                                        //add 23:59 to the deadline date
                                                                                                        $modified = date('Y-m-d H:i:s',strtotime('+23 hour +59 minutes',strtotime($start)));
                                                                                                        $deadLineDate = new DateTime($modified);
                                                                                                        $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                                                        ?>



                                                                                                        <b class="text-danger ml-5"><i class="fa fa-clock-o"></i> Deadline : </b><?= $deadLineDate->format('Y-m-d H:i:s') ?>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">

                                                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assignment['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                                                        <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> ClassRoomSecurity::encrypt($assignment['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                                                        <?php if(empty($submited) && $isOutOfDeadline == false):?>
                                                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> ClassRoomSecurity::encrypt($assignment['assID']), 'groupID' => ClassRoomSecurity::encrypt($assignment['groupID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                                        <?php endif ?>
                                                                                                        <?php
                                                                                                        if(!empty($submited) && $isOutOfDeadline == false):?>
                                                                                                            <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> ClassRoomSecurity::encrypt($assignment['assID']), 'submit_id' => ClassRoomSecurity::encrypt($submited['submitID']), 'groupID' => ClassRoomSecurity::encrypt($assignment['groupID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                                        <?php endif ?>
                                                                                                        <?php if($isOutOfDeadline == true):?>
                                                                                                            <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                                                        <?php endif ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endforeach; ?>


                                                                                        <?php if (!empty($assignmentAllItems)): ?>

                                                                                            <?php foreach ($assignmentAllItems as $assignmentAllItem ): ?>

                                                                                                <div class="card-footer p-2 material-background mt-3 border-top border-bottom">
                                                                                                    <div class="card-header border-0">
                                                                                                        <h5 class="ml-3"><i class="fas fa-clipboard-list"></i> <span class="assignment-header"><?php  echo ucwords($assignmentAllItem['assName'])?></span></h5>
                                                                                                        <p class="card-text ml-5"><span style="color:green"> Description: </span>  <?= $assignmentAllItem['ass_desc'] ?> </p>

                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-6">
                                                                                                            <?php
                                                                                                            //variable to check if there is any submission
                                                                                                            $submitedAll = GroupAssSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $assignmentAllItem['groupID'],':assID' => $assignmentAllItem['assID']])->asArray()->one();
                                                                                                            ?>



                                                                                                            <?php
                                                                                                            // check if dead line of submit assignment is meet
                                                                                                            $currentDateTime = new DateTime("now");
                                                                                                            //set an date and time to work with
                                                                                                            $start = $assignmentAllItem['finishDate'];

                                                                                                            //add 23:59 to the deadline date
                                                                                                            $modified = date('Y-m-d H:i:s',strtotime('+23 hour +59 minutes',strtotime($start)));
                                                                                                            $deadLineDate = new DateTime($modified);
                                                                                                            $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                                                            ?>



                                                                                                            <b class="text-danger ml-5"><i class="fa fa-clock-o"></i> Deadline : </b><?= $deadLineDate->format('Y-m-d H:i:s') ?>
                                                                                                        </div>
                                                                                                        <div class="col-md-6">

                                                                                                            <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                                                            <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                                                            <?php if(empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                                                <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID']), 'groupID' => ClassRoomSecurity::encrypt($assignmentAllItem['groupID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                                            <?php endif ?>
                                                                                                            <?php
                                                                                                            if(!empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                                                <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID']), 'submit_id' => ClassRoomSecurity::encrypt($submitedAll['submitID']), 'groupID' => ClassRoomSecurity::encrypt($assignmentAllItem['groupID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                                            <?php endif ?>
                                                                                                            <?php if($isOutOfDeadline == true):?>
                                                                                                                <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                                                            <?php endif ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            <?php endforeach; ?>
                                                                                        <?php endif; ?>
                                                                                    <?php elseif (!empty($assignmentAllItems)): ?>

                                                                                        <?php foreach ($assignmentAllItems as $assignmentAllItem ): ?>

                                                                                            <div class="card-footer p-2 material-background mt-3 border-top border-bottom">
                                                                                                <div class="card-header border-0">
                                                                                                    <h5 class="ml-3"><i class="fas fa-clipboard-list"></i> <span class="assignment-header"><?php  echo ucwords($assignmentAllItem['assName'])?></span></h5>
                                                                                                    <p class="card-text ml-5"><span style="color:green"> Description: </span>  <?= $assignmentAllItem['ass_desc'] ?> </p>

                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6">
                                                                                                        <?php
                                                                                                        //variable to check if there is any submission
                                                                                                        $submitedAll = GroupAssSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $assignmentAllItem['groupID'],':assID' => $assignmentAllItem['assID']])->asArray()->one();
                                                                                                        ?>



                                                                                                        <?php
                                                                                                        // check if dead line of submit assignment is meet
                                                                                                        $currentDateTime = new DateTime("now");
                                                                                                        //set an date and time to work with
                                                                                                        $start = $assignmentAllItem['finishDate'];

                                                                                                        //add 23:59 to the deadline date
                                                                                                        $modified = date('Y-m-d H:i:s',strtotime('+23 hour +59 minutes',strtotime($start)));
                                                                                                        $deadLineDate = new DateTime($modified);
                                                                                                        $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                                                        ?>


                                                                                                        <b class="text-danger ml-5"><i class="fa fa-clock-o"></i> Deadline : </b><?= $deadLineDate->format('Y-m-d H:i:s') ?>
                                                                                                    </div>
                                                                                                    <div class="col-md-6">

                                                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                                                        <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                                                        <?php if(empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID']), 'groupID' => ClassRoomSecurity::encrypt($assignmentAllItem['groupID'])])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                                        <?php endif ?>
                                                                                                        <?php
                                                                                                        if(!empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                                            <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> ClassRoomSecurity::encrypt($assignmentAllItem['assID']), 'submit_id' => ClassRoomSecurity::encrypt($submitedAll['submitID']), 'groupID' => ClassRoomSecurity::encrypt($assignmentAllItem['groupID'])])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                                        <?php endif ?>
                                                                                                        <?php if($isOutOfDeadline == true):?>
                                                                                                            <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                                                        <?php endif ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endforeach; ?>
                                                                                    <?php else: ?>
                                                                                        <div class="card-footer p-2 bg-white border-top">
                                                                                            <h5 class="text-danger float-right mr-4">No Assignment provided yet</h5>
                                                                                        </div>
                                                                                    <?php endif; ?>
<!--end of displaying assignment-->
                                                                                    <?php
                                                                                    $studentList = StudentGroup::find()->select('student.fname, student.mname, student.lname, student.reg_no, student.programCode, student.phone ')->join('INNER JOIN', 'student', 'student.reg_no = student_group.reg_no')->where('groupID = :groupID ', [':groupID' => $item['groupID']])->asArray()->all();
                                                                                    ?>
                                                                                    <div class="p-5">
                                                                                        <div class="card-header bg-primary">
                                                                                            <h4>Group Members</h4>
                                                                                        </div>
                                                                                        <!-- -----------------------------group member ---------------------------------------->
                                                                                        <?php foreach ($studentList as $student) : ?>
                                                                                            <div class="card-footer p-2 bg-white shadow-lg">
                                                                                                <li class="ml-xl-5 p-1 col-md-9 text-muted" style="display: inline-block"><?= strtoupper($student['fname']) ?> &nbsp; <?= strtoupper($student['mname']) ?> &nbsp; <?= strtoupper($student['lname']) ?> &nbsp; <?= strtoupper($student['reg_no']) ?> &nbsp; <?= strtoupper($student['programCode']) ?> &nbsp; <?= strtoupper($student['phone']) ?> </li>
                                                                                            </div>
                                                                                        <?php endforeach; ?>
                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                            <?php
                                                                            $count--;
                                                                            ?>
                                                                        </div>

                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                            <!-- ########################################### GROUPS END ######################################## -->
                                                        </div>



                                                </section>
                                                <!-- ########################################### group by instructor end ######################################## -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-materials">
                                        <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                                            <div class="card-body" >
                                                <div class="tab-content" id="custom-tabs-four-tabContent">


                                                    <!-- ########################################### group by student ######################################## -->

                                                    <!-- Left col -->
                                                    <section class="col-lg-12">





                                                        <div class="body-content mb-4">
                                                            <!-- Content Wrapper. Contains page content -->

                                                            <div class="container-fluid">

                                                                <div class="row">
                                                                    <!-- Left col -->
                                                                    <section class="col-lg-12">
                                                                        <!-- Custom tabs (Charts with tabs)-->

                                                                        <div class="card">
                                                                            <a value="<?= Url::to(['/student/create-group', 'cid' => $cid]) ?>" class="btn btn-primary btn-sm float-right m-0 col-xs-12" id = "group_modal_button">
                                                                                <i class="fas fa-plus fa-lg"></i> CREATE GROUP
                                                                            </a>
                                                                            <?php
                                                                            Modal::begin([
                                                                                'title' => '<h2>CREATE GROUP</h2>',
                                                                                'id' => 'group_modal',
                                                                                'size' => 'modal-lg'
                                                                            ]);

                                                                            echo "<div id = 'group_modal_content'></div>";
                                                                            Modal::end();
                                                                            ?>
                                                                        </div>
                                                                        <!-- /.card -->

                                                                    </section>
                                                                    <!-- /.Left col -->
                                                                    <!-- right col (We are only adding the ID to make the widgets sortable)-->

                                                                    <!-- right col -->
                                                                </div>

                                                            </div><!--/. container-fluid -->

                                                        </div>






<!--                                                                                                            --><?php
//                                                                                                            echo '<pre>';
//                                                                                                            var_dump($noGroupAssignment);
//                                                                                                            echo '</pre>';
//                                                                                                                                                     exit;
//                                                                                                            ?>


                                                        <div class="accordion" id="accordionExample_33">
                                                            <?php foreach( $noGroupAssignment as $itemNoGroup ) : ?>


                                                                 <?php

                                                                    $checkGroup = Groups::find()->join('INNER JOIN','student_group','groups.groupID = student_group.groupID')->where('groups.generation_type = :typeID AND student_group.reg_no = :reg_no', [':typeID' => $itemNoGroup['typeID'], ':reg_no' => $reg_no])->count();

                                                                ?>

                                                                <?php if ($checkGroup == 0): ?>
                                                                <div class="card">
                                                                    <div class="card shadow-lg">
                                                                        <div class="card-header p-2" id="heading<?=$noGroupAssignmentCount?>">
                                                                            <h2 class="mb-0">
                                                                                <div class="row">
                                                                                    <div class="col-sm-11">
                                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$noGroupAssignmentCount?>" aria-expanded="true" aria-controls="collapse<?=$noGroupAssignmentCount?>">

                                                                                            <div class="row">
                                                                                                <div class="col-sm-6">
                                                                                                    <h4><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header "><?php echo $itemNoGroup['generation_type']." ";?></span></h4>
                                                                                                    <h6><span>Assignment Name: </span><span class="assignment-header "><?php echo $itemNoGroup['assName']." ";?></span></h6>
                                                                                                </div>
                                                                                                <div class="col-sm-4">
                                                                                                    <div><img src="<?= Yii::getAlias('@web/img/warning.png') ?>" width="30" height="30" class="mt-3 mr-3"><h6 class="text-danger">Your not belong to any group in this assignment, Please create group with maximum member of <?= $itemNoGroup['max_groups_members'] ?> include your self</h6></div>
                                                                                                    <h4 class="text-danger font-italic">CLICK TO CREATE GROUP FOR THIS ASSIGNMENT</h4>
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


                                                                        <div class="card mx-3 p-4">

                                                                            <div class="mb-2">
                                                                                <h5 class="text-warning font-italic">Your name will be added automatic in a group you create,So add  <?= $itemNoGroup['max_groups_members'] -1 ." " ?>member</h5>
                                                                            </div>

                                                                            <?php $form = ActiveForm::begin();?>


                                                                            <?= $form->field($model, 'groupName')->textInput(['class' => 'col-sm-7', 'size' => 100])->label('Group Name') ?>
                                                                            <?php
                                                                            echo $form->field($model,'memberStudents[]')->dropDownList(ArrayHelper::map(Student::find()->
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
                                                                                ),['data-placeholder'=>'-- Search member to add --','class' => 'form-control form-control-sm','id' => 'group_members'.$noGroupAssignmentCount, 'multiple'=>true,'style'=>'width:100%'])

                                                                            ?>

                                                                            <?=  $form->field($model, 'generation_type')->hiddenInput(['value' => $itemNoGroup['typeID']])->label(false) ?>


                                                                            <div class="form-group">
                                                                                <?= Html::submitButton(Yii::t('app', 'CREATE'), ['class' => 'btn btn-primary']) ?>
                                                                            </div>

                                                                            <?php ActiveForm::end(); ?>

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
                                                                <?php endif; ?>

                                                                <?php
                                                                $noGroupAssignmentCount--;
                                                                ?>

                                                            <?php endforeach; ?>
                                                        </div>

                                                    </section>
                                                    <!-- ########################################### group by student end ######################################## -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </section>
            </div>
        </div>
    </div><!--/. container-fluid -->
</div>
</div>



