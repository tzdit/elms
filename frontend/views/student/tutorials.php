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
use frontend\models\ClassRoomSecurity;

/* @var $this yii\web\View */
$this->params['courseTitle'] ='<img src="/img/tutorials.png" height="25px" width="25px"/> '.$cid.' Tutorials';
$this->title ='Tutorials';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
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
                    <div class="card-body">
                     
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <?php
                                if(empty($tutorials)){
                                    echo "<p class='text-muted text-lg text-center p-1 responsivetext'>";
                                    echo "No tutorial found";
                                    echo "</p>";
                                }
                                ?>


                                <!-- ########################################### tutorial work ######################################## -->
                                <?php $tutt = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->count(); ?>
                                    <div class="accordion" id="accordionExample_4">

                                        <?php foreach( $tutorials as $tutorial ) : ?>
 
                                                <div class="card shadow-lg" data-toggle="collapse" data-target="#collapse<?=$tutt?>" aria-expanded="true" aria-controls="collapse<?=$tutt?>">
                                                    <div class="card-header p-2" id="heading<?=$tutt?>">
                                                        <h2 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-sm-11">
                                                                    <button class="btn btn-link btn-block text-left col-md-11" type="button" >
                                                                        <h5 class="responsiveheader"> <img src="/img/tutorials.png" height="25px" width="25px"/> <span class="assignment-header responsiveheader"><?php echo $tutorial -> assName;?></span></h5>
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse<?=$tutt?>" class="collapse" aria-labelledby="heading<?=$tutt?>" data-parent="#accordionExample_4">
                                                        <div class="card-body">
                                                            <p><span style="color:green"> Hint:</span> <span class="text-sm responsivetext"> <?= $tutorial -> ass_desc ?></span></p>
                                                        </div>
                                                        <div class="card-footer p-2 bg-white border-top">
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($tutorial->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                    <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> ClassRoomSecurity::encrypt($tutorial->assID)])?>" class="btn btn-sm btn-info float-right"><span><i class="fas fa-eye"> View</i></span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                              
                                            </div>
                                            <?php
                                            $tutt--;

                                            ?>
                                        <?php endforeach ?>


                                   
                                <!-- ########################################### tutorial work end ######################################## -->
                            </div>
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
