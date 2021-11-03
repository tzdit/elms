<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use common\models\Material;
use common\models\Instructor;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\Submit;
use common\models\GroupAssignmentSubmit;
use frontend\models\UploadMaterial;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Class';
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
                        <h2>Group Assignments</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### group assignment work ######################################## -->

                                <?php $groupAssArrey =Assignment::find()->where('assignment.course_code = :cid AND assignment.assType = :group  OR assignment.assType = :allgroup', ['cid' => $cid, 'group' => 'groups', ':allgroup' => 'allgroups'])->joinWith('groupAssignments')->orderBy(['assID' => SORT_DESC ])->all() ?>


                                <?php $groupAssCount =Assignment::find()->where('assignment.course_code = :cid AND assignment.assType = :group OR assignment.assType = :allgroup', ['cid' => $cid, 'group' => 'groups', ':allgroup' => 'allgroups'])->joinWith('groupAssignments')->count()?>


                                    <div class="accordion" id="accordionExample_11">

                                        <?php foreach($groupAssArrey as $groupAss) : ?>
                                            <?php foreach($groupAss->groupAssignments as $groupAssLoop) : ?>
                                                <div class="card">
                                                    <div class="card shadow-lg">
                                                        <div class="card-header p-2" id="group<?= $groupAssCount?>">
                                                            <h2 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-sm-11">
                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$groupAssCount?>" aria-expanded="true" aria-controls="collapse<?=$groupAssCount?>">
                                                                            <h5><i class="fas fa-clipboard-list"></i><span class="assignment-header"><?php  echo " ".ucfirst($groupAss -> assName); ?></span></h5>
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                                    </div>
                                                                </div>
                                                            </h2>
                                                        </div>

                                                        <div id="collapse<?= $groupAssCount ?>" class="collapse"  aria-labelledby="heading<?=$groupAssCount?>" data-parent="#accordionExample_11">
                                                            <div class="card-body">
                                                                <p>
                                                                    <span style="color: green">Description:</span>
                                                                    <span><?= $groupAss-> ass_desc ?></span>
                                                                </p>
                                                            </div>

                                                            <div class="card-footer p-2 bg-white border-top">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b>Deadline:</b> <?= $groupAss -> finishDate ?>
                                                                    </div>

                                                                    <div class="col-md-6">

                                                                        <?php
                                                                        //variable to check if there is any submission
                                                                        $submited = GroupAssignmentSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $groupAssLoop->groupID,':assID' => $groupAss->assID])->all();
                                                                        ?>

                                                                        <?php
                                                                        //  check if dead line of submit assinemnt is meeted
                                                                        $deadLineDate = new DateTime($groupAss->finishDate);
                                                                        $currentDateTime = new DateTime("now");

                                                                        $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                        ?>

                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $groupAss->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                        <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $groupAss->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                        <?php if(empty($submited) && $isOutOfDeadline == false):?>
                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> $groupAss->assID,'groupID' => $groupAssLoop->groupID ])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                        <?php endif ?>

                                                                        <?php if(!empty($submited) && $isOutOfDeadline == false):?>
                                                                            <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> $groupAss->assID,'groupID' => $groupAssLoop->groupID])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
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
                                            <?php endforeach ?>
                                            <?php
                                            $groupAssCount--;

                                            ?>
                                        <?php endforeach ?>
                                    </div>


                                <?php

                                // echo '<pre>';
                                // print_r($groupAss);
                                // echo '</per>';
                                // VarDumper::dump($groupAss)
                                ?>
                                <!-- ########################################### group assignment work end ######################################## -->

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
