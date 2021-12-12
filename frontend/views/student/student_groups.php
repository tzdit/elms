<?php

use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\StudentGroup;
use frontend\models\GroupAssSubmit;
use yii\helpers\Url;


/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
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
                <!-- Left col -->
                <section class="col-lg-12">

                    <div class="card-header p-0 border-bottom-0 ml-3">
                        <h2>Group Assignment</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <?php
                                if(empty($studentGroupsList)){
                                    echo "<p class='text-muted text-lg'>";
                                    echo "No group found";
                                    echo "</p>";
                                }
                                ?>

                                <!-- ########################################### Course materials ######################################## -->

                                <div class="accordion" id="accordionExample_3">
                                    <?php foreach( $studentGroupsList as $item ) : ?>
                                        <div class="card">
                                            <div class="card shadow-lg">
                                                <div class="card-header p-2" id="heading<?=$count?>">
                                                    <h2 class="mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-11">
                                                                <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$count?>" aria-expanded="true" aria-controls="collapse<?=$count?>">
                                                                    <h4><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header "><?php echo $item['generation_type']." ";?><span class="font-italic text-info font-weight-normal"><?php echo "(".$item['groupName'].")"; ?></span></span></h4>
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
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

                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $assignment['assID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                        <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $assignment['assID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                        <?php if(empty($submited) && $isOutOfDeadline == false):?>
                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> $assignment['assID'], 'groupID' => $assignment['groupID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                        <?php endif ?>
                                                                        <?php
                                                                        if(!empty($submited) && $isOutOfDeadline == false):?>
                                                                            <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> $assignment['assID'], 'submit_id' => $submited['submitID'], 'groupID' => $assignment['groupID']])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
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

                                                                                <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $assignmentAllItem['assID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                                <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $assignmentAllItem['assID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                                <?php if(empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                    <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> $assignmentAllItem['assID'], 'groupID' => $assignmentAllItem['groupID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                <?php endif ?>
                                                                                <?php
                                                                                if(!empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                    <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> $assignmentAllItem['assID'], 'submit_id' => $submitedAll['submitID'], 'groupID' => $assignmentAllItem['groupID']])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
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

                                                                            <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $assignmentAllItem['assID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                            <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $assignmentAllItem['assID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                            <?php if(empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> $assignmentAllItem['assID'], 'groupID' => $assignmentAllItem['groupID']])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                            <?php endif ?>
                                                                            <?php
                                                                            if(!empty($submitedAll) && $isOutOfDeadline == false):?>
                                                                                <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> $assignmentAllItem['assID'], 'submit_id' => $submitedAll['submitID'], 'groupID' => $assignmentAllItem['groupID']])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
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
                            <!-- ########################################### Course materials end ######################################## -->
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div><!--/. container-fluid -->
</div>
</div>