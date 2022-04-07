<?php

use frontend\models\ClassRoomSecurity;
use yii\helpers\Url;
use common\models\Assignment;
use common\models\Submit;


/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Assignment';
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
                <!-- Left col -->
                <section class="col-lg-12">

                    <div class="card-header p-0 border-bottom-0 ml-3">
                        <h2>Individual Assignments</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
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
                                                                        <h5><i class="fas fa-clipboard-list"></i><span class="assignment-auto"><?php echo " "."Assignment"." ".$ass.":"." "; ?></span> <span class="assignment-header"><?php  echo ucwords($assign -> assName)?></span></h5>
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

                                                                    // to check if assignment needs to be resubmitted or not
                                                                    $resubmit_mode = $assign->submitMode;

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
                                                                        <!-- submitMode -can resubmit or cant resubmit -->
                                                                    <?php if($resubmit_mode == "resubmit" && !empty($submited) && $isOutOfDeadline == false):?>
                                                                        <a href="<?= Url::toRoute(['/student/resubmit','assID'=> ClassRoomSecurity::encrypt($assign->assID), 'submit_id' => ClassRoomSecurity::encrypt($submited->submitID)])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                    <?php endif ?>
                                                                    <!-- end of resubmit -->

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

<?php
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
  });
//Remember active tab
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

localStorage.setItem('activeTab', $(e.target).attr('href'));

});

var activeTab = localStorage.getItem('activeTab');

if(activeTab){

$('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');

}
  
});
JS;
$this->registerJs($script);
?>
