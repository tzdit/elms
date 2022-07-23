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
use common\models\Instructor;


/* @var $this yii\web\View */

$this->params['courseTitle'] ="<i class='fa fa-calendar'></i> Academic Year Management";
$this->title = 'Academic Year';
$this->params['breadcrumbs'] = [
    ['label'=>'Dashboard', 'url'=>Url::to('/home/dashboard')],
    ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">
           
            <div class="row">

                <section class="col-lg-12 p-4 ">
                   <div class="row  border d-flex text-center justify-content-center ">
                        <div class="col-sm-4 text-primary  m-1 d-flex  p-3  text-center justify-content-center" >
                    <a href="#" value=""  class="back">
                <i class="fa fa-arrow-left "> </i> Migrate Backwards
            </a>
</div>
<div class="col-sm-2 text-sm p-3 m-1" >
    <?=yii::$app->session->get('currentAcademicYear')->title?>
</div>
 <div class="col-sm-4 text-primary m-1 d-flex  p-3  text-center justify-content-center" >
            <a href="#"  value="" data-toggle="modal" data-target="#migrateOptionsmodal" id = "group_modal_button">
                 Migrate Forwards <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a></div>
           
                        </div>
                           
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### group by  instructor ######################################## -->

                                            <!-- Left col -->
                                            <section class="col-lg-12">


                                                <div class="card-body" >
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                                    <div class="container border p-1 pl-3" id="accordion">
                                                    <div class="row text-sm text-bold ">
                                                            <div class="col-sm">Title</div>
                                                            <div class="col-sm">Date Launched</div>
                                                            <div class="col-sm">Duration</div>
                                                            <div class="col-sm">Status</div>

                                                        </div>
                                                        <?php
                                                        
                                                        if(empty($academicyears)){
                                                        
                                                            echo '<div style="width:91%"  class="container border p-2  d-flex justify-content-center p-5"><span class="text-center text-muted text-lg"><i class="fa fa-info-circle"></i> No Academic Years Found</span></div>';
                                                        
                                                        }
                                                    
                                                        ?>
                                                         
                                                        <?php
                                                        foreach($academicyears as $academicyear)
                                                        {

                                                        ?>
                                                        <div class="row text-sm <?=$academicyear->status=='ongoing'?'text-success':''?>">
                                                            <div class="col-sm"><?=$academicyear->title?></div>
                                                            <div class="col-sm"><?=$academicyear->date_launched?></div>
                                                            <div class="col-sm"><?=$academicyear->duration?></div>
                                                            <div class="col-sm"><?=$academicyear->status?></div>

                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        

                                                            </div>

                                                            </div>


                                                      

                                                    </div>
                                                    <!-- ########################################### GROUPS END ######################################## -->
                                              

                                              <?=$this->render("migrateOptions")?>

                                            </section>
                                            <!-- ########################################### group by instructor end ######################################## -->
                                    
                             
                             

                                                           



                               

                                                                           <?php $script = <<<JS
                                                                            $(document).ready(function(){

                                                                                $(document).on('click', '.back', function(){
                                                                                                var quiz = $(this).attr('id');
                                                                                                Swal.fire({
                                                                                            title: 'Migrate Backwards?',
                                                                                            text: "You won't be able to revert this!",
                                                                                            icon: 'question',
                                                                                            showCancelButton: true,
                                                                                            confirmButtonColor: '#3085d6',
                                                                                            cancelButtonColor: '#d33',
                                                                                            confirmButtonText: 'Migrate'
                                                                                            }).then((result) => {
                                                                                            if (result.isConfirmed) {

                                                                                            $.ajax({
                                                                                                url:'/admin/migrate-backwards',
                                                                                                method:'post',
                                                                                                async:false,
                                                                                                dataType:'JSON',
                                                                                                data:{},
                                                                                                success:function(data){
                                                                                                if(data.backward){
                                                                                                    Swal.fire(
                                                                                                        'Migration successful !',
                                                                                                         data.backward,
                                                                                                        'success'
                                                                                            )
                                                                                            setTimeout(function(){
                                                                                                window.location.reload();
                                                                                            }, 100);


                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    Swal.fire(
                                                                                                        'Migration Failed!',
                                                                                                        data.failure,
                                                                                                        'error'
                                                                                            )
                                                                                            setTimeout(function(){
                                                                                                window.location.reload();
                                                                                            }, 100);

                                                                                                }
                                                                                                }
                                                                                            })

                                                                                            }
                                                                                            })

                                                                                            })                                                                    
                                                                            });
                                                                            JS;
                                                                            $this->registerJs($script);

                                                                            ?>

                                                                        </div>

                                                                </div>



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


<?php
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
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
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>




