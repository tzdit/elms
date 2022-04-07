<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Assignment;
use common\models\Student;
use common\models\Submit;
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
$this->params['courseTitle'] =$cid. " - Assignments";
$this->title = 'Assignments';
$this->params['breadcrumbs'] = [
    ['label'=>'Class', 'url'=>Url::to(['/student/classwork', 'cid'=>$cid])],
    ['label'=>$this->title]
];

?>

<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"  ><a class="nav-link active" href="#tab_1" data-toggle="tab"><i class="fas fa-user"></i> Individual Assignments </a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><i class="fas fa-users"></i>Group Assignments </a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  <div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">

            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">


                    <div class=" card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### Assignments ######################################## -->
                                <?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->count(); ?>

                                    <div class="accordion" id="accordionExample">
                                        <?php $assk = "Assignment".$ass ;
                                        $assk = "Assignment".$ass;
                                        ?>
                                        <?php
                                        if(empty($assignments)){
                                            echo "<p class='text-muted text-lg'>";
                                            echo "No assignment found";
                                            echo "</p>";
                                        }
                                        ?>

                                        <?php foreach( $assignments as $assign ) : ?>

                                            <div class="card">
                                                <div class="card shadow-lg">
                                                    <div class="card-header p-2" id="heading<?=$ass?>">
                                                        <h2 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-sm-11">
                                                                    <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$ass?>" aria-expanded="true" aria-controls="collapse<?=$ass?>">
                                                                        <h5><i class="fas fa-clipboard-list"></i><span class="assignment-auto"></span> <span class="assignment-header"><?php  echo ucwords($assign -> assName)?></span></h5>
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse<?=$ass?>" class="collapse" aria-labelledby="heading<?=$ass?>" data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <p><span style="color:green"> Description: </span>  <?= $assign -> ass_desc ?> </p>
                                                        </div>
                                                        <div class="card-footer p-2 bg-white border-top">
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <?php
                                                                    //variable to check if there is any submission
                                                                    $submited = Submit::find()->where('reg_no = :reg_no AND assID = :assID', [ ':reg_no' => $reg_no,':assID' => $assign->assID])->one();
                                                                    ?>

                                                                    <?php
                                                                    // check if dead line of submit assignment is meet
                                                                    $currentDateTime = new DateTime("now");
                                                                    //set an date and time to work with
                                                                    $start = $assign->finishDate;

                                                                    //add 23:59 to the deadline date
                                                                    $modified = date('Y-m-d H:i:s',strtotime('+23 hour +59 minutes',strtotime($start)));
                                                                    $deadLineDate = new DateTime($modified);
                                                                    $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                    ?>

                                                                    <b class="text-danger ml-3"><i class="fa fa-clock-o"></i> Deadline : </b><?= $deadLineDate->format('Y-m-d H:i:s') ?>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assign->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                    <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> ClassRoomSecurity::encrypt($assign->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                    <?php if(empty($submited) && $isOutOfDeadline == false):?>
                                                                        <a href="<?= Url::toRoute(['/student/submit_assignment','assID'=> ClassRoomSecurity::encrypt($assign->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                    <?php endif ?>

                                                                    <?php if(!empty($submited) && $isOutOfDeadline == false):?>
                                                                        <a href="<?= Url::toRoute(['/student/resubmit','assID'=> ClassRoomSecurity::encrypt($assign->assID), 'submit_id' => ClassRoomSecurity::encrypt($submited->submitID)])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                    <?php endif ?>

                                                                    <?php if($isOutOfDeadline == true):?>
                                                                        <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                    <?php endif ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $ass--;
                                            ?>

                                        <?php endforeach ?>


                                    </div>

                                <?php $labb = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->count(); ?>
                                <!-- ########################################### Assignments end ######################################## -->

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div><!--/. container-fluid -->
    </div>
</div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
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

                                                                                    <?php
                                                                                    $studentList = StudentGroup::find()->select('student.fname, student.mname, student.lname')->join('INNER JOIN', 'student', 'student.reg_no = student_group.reg_no')->where('groupID = :groupID ', [':groupID' => $item['groupID']])->asArray()->all();
                                                                                    ?>
                                                                                    <div class="p-5">
                                                                                        <div class="card-header bg-primary">
                                                                                            <h4>Group Members</h4>
                                                                                        </div>
                                                                                        <?php foreach ($studentList as $student) : ?>
                                                                                            <div class="card-footer p-2 bg-white shadow-lg">
                                                                                                <li class="ml-xl-5 p-1 col-md-9 text-muted" style="display: inline-block"><?= strtoupper($student['fname']) ?> &nbsp; <?= strtoupper($student['mname']) ?> &nbsp; <?= strtoupper($student['lname']) ?> </li>
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

                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->


        </div>
    </div>


<?php 
$script = <<<JS

JS;
$this->registerJs($script);
?>


