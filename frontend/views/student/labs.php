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

                                <!-- ########################################### lab work ######################################## -->
                                <?php $labb = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->count(); ?>

                                    <div class="accordion" id="accordionExample_3">
                                        <?php foreach( $labs as $lab ) : ?>
                                            <div class="card">
                                                <div class="card shadow-lg">
                                                    <div class="card-header p-2" id="heading<?=$labb?>">
                                                        <h2 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-sm-11">
                                                                    <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$labb?>" aria-expanded="true" aria-controls="collapse<?=$labb?>">
                                                                        <h5><i class="fas fa-clipboard-list"></i> <span class="assignment-header"><?php echo "Lab ".$labb;?></span></h5>

                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse<?=$labb?>" class="collapse" aria-labelledby="heading<?=$labb?>" data-parent="#accordionExample_3">
                                                        <div class="card-body">
                                                            <p><span style="color:green"> About: </span> <?= $lab -> assName ?></p>
                                                        </div>
                                                        <div class="card-footer p-2 bg-white border-top">
                                                            <div class="row">
                                                                <div class="col-md-8 float-left">
                                                                    <b> Deadline : </b> <?= $lab -> finishDate ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    $submited = Submit::find()->where('reg_no = :reg_no AND assID = :assID', [ ':reg_no' => $reg_no,':assID' => $lab->assID])->all();
                                                                    ?>

                                                                    <?php
                                                                    // check if dead line of submit assinemnt is meeted
                                                                    $deadLineDate = new DateTime($lab->finishDate);
                                                                    $currentDateTime = new DateTime("now");

                                                                    $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                    ?>

                                                                    <?php if(empty($submited) && $isOutOfDeadline == false):?>
                                                                        <a href="<?= Url::toRoute(['/student/submit_assignment','assID'=> $lab->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                    <?php endif ?>

                                                                    <?php if(!empty($submited) && $isOutOfDeadline == false):?>
                                                                        <a href="<?= Url::toRoute(['/student/resubmit','assID'=> $lab->assID])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                    <?php endif ?>

                                                                    <?php if($isOutOfDeadline == true):?>
                                                                        <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                    <?php endif ?>

                                                                    <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $lab->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                    <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $lab->assID])?>" class="btn btn-sm btn-info float-right"><span><i class="fas fa-eye"> View</i></span></a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $labb--;

                                                    ?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                <!-- ########################################### lab work end ######################################## -->
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
