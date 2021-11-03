<?php
use common\models\Material;
use yii\helpers\Url;


/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Course Material';
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
                        <h2>Course materials</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">


                                <!-- ########################################### materials ######################################## -->
                                <?php $mat = Material::find()->where(['course_code' => $cid])->count(); ?>

                                <?php $videos = Material::find()->where('course_code = :course_code AND material_type = :material_type', [ ':course_code'=> $cid, ':material_type' => 'Videos'])->count(); ?>

                                <?php $notesAndBooks = Material::find()->where('course_code = :course_code AND material_type = :material_type', [ ':course_code'=> $cid, ':material_type' => "Notes"])->count(); ?>

                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <a href="<?= Url::toRoute(['videos-and-notes/videos', 'cid' => $cid])?>" class="small-box bg-success" >

                                                <div class="inner m-2">
                                                    <h4 class="mb-0">Videos</h4>

                                                    <h2 class="mb-4"> <?= $videos ?></h2>
                                                </div>

                                                <div class="icon">
                                                    <i class="mt-n4"><img src="<?= Yii::getAlias('@web/img/videos.png') ?>"></i>
                                                </div>

                                            </a>
                                        </div>

                                        <div class="col-lg-3 col-6">
                                            <a href="<?= Url::toRoute(['videos-and-notes/notes', 'cid' => $cid])?>" class="small-box bg-success" >

                                                <div class="inner mt-2">
                                                    <h4 class="mb-0"> Notes & Books </h4>

                                                    <h2 class="mb-4"><?= $notesAndBooks ?></h2>
                                                </div>


                                                <div class="icon">
                                                    <i class="mt-n4"><img src="<?= Yii::getAlias('@web/img/books.png') ?>"></i>
                                                </div>

                                            </a>
                                        </div>
                                    </div>

                                <!-- ########################################### materials end ######################################## -->
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
