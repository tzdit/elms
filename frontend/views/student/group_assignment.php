<?php

use yii\helpers\Url;
use common\models\Assignment;
use common\models\Groups;
use common\models\GroupAssignmentSubmit;
use yii\web\NotFoundHttpException;


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


                                <?php $generationType = \common\models\GroupGenerationTypes::findOne($generationType) ?>

<!--                                --><?php //$groupAssArrey = Assignment::find()->where('assignment.course_code = :cid AND assignment.assType = :group  OR assignment.assType = :allgroup', ['cid' => $cid, 'group' => 'groups', ':allgroup' => 'allgroups'])->joinWith('groupGenerationAssignments')->orderBy(['assID' => SORT_DESC ])->one() ?>

                                <?php $assId = \common\models\GroupGenerationAssignment::find()->where('gentypeID = :gentypeid', [':gentypeid' => $generationType->typeID])->one();
                                    if ( is_null($assId)){
                                        throw new NotFoundHttpException(Yii::t('app', 'No such assignment'));
                                    }
                                ?>

<!--                                                                   --><?php
//                                                                  echo '<pre>';
//                                                                         var_dump($assId);
//                                                                     echo '</pre>';
//                                                                     exit;
//                                                                   ?>

                                <!--                                --><?php //$groupAssCount =Assignment::find()->where('assignment.course_code = :cid AND assignment.assType = :group OR assignment.assType = :allgroup', ['cid' => $cid, 'group' => 'groups', ':allgroup' => 'allgroups'])->joinWith('groupGenerationAssignments')->count()?>

                                    <?php $groupAssCount = 1;
                                    $groupAssArrey = Assignment::findOne($assId->assID) ?>

                                    <div class="accordion" id="accordionExample_11">

                                                <div class="card">
                                                    <div class="card shadow-lg">
                                                        <div class="card-header p-2" id="group<?= $groupAssCount?>">
                                                            <h2 class="mb-0">
                                                                <div class="row">
                                                                    <div class="col-sm-11">
                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$groupAssCount?>" aria-expanded="true" aria-controls="collapse<?=$groupAssCount?>">
                                                                            <h5><i class="fas fa-clipboard-list"></i><span class="assignment-header"><?php  echo " ".ucfirst($groupAssArrey -> assName); ?></span></h5>
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
                                                                    <span><?= $groupAssArrey-> ass_desc ?></span>
                                                                </p>
                                                            </div>

                                                            <div class="card-footer p-2 bg-white border-top">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <b>Deadline:</b> <?= $groupAssArrey -> finishDate ?>
                                                                    </div>

                                                                    <div class="col-md-6">

                                                                        <?php
                                                                        //variable to check if there is any submission
                                                                        $submited = GroupAssignmentSubmit::find()->where('groupID = :groupID AND assID = :assID', [ ':groupID' => $groupID,':assID' => $groupAssArrey->assID])->all();
                                                                        ?>

                                                                        <?php
                                                                        //  check if dead line of submit assinemnt is meeted
                                                                        $deadLineDate = new DateTime($groupAssArrey->finishDate);
                                                                        $currentDateTime = new DateTime("now");

                                                                        $isOutOfDeadline =   $currentDateTime > $deadLineDate;


//                                                                         echo '<pre>';
//                                                                             var_dump($groupID);
//                                                                         echo '</pre>';
//                                                                         exit;


                                                                        ?>

                                                                        <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $groupAssArrey->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                        <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $groupAssArrey->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-eye"> View</i></span></a>

                                                                        <?php if(empty($submited) && $isOutOfDeadline == false):?>
                                                                            <a href="<?= Url::toRoute(['/student/group_assignment_submit','assID'=> $groupAssArrey->assID,'groupID' => $groupID ])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                        <?php endif ?>

                                                                        <?php if(!empty($submited) && $isOutOfDeadline == false):?>
                                                                            <a href="<?= Url::toRoute(['/student/group_resubmit','assID'=> $groupAssArrey->assID,'groupID' => $groupID])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
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
