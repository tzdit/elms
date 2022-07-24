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
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] ="<i class='fa fa-pen text-info'></i> Quizzes";
$this->title = 'Quizzes';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Dashboard', 'url'=>Url::to(['/instructor/class-dashboard','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">
           
            <div class="row">

                <section class="col-lg-12">
                   <div class="row  d-flex text-center justify-content-center ">
                        <div class="col-sm-5 text-info bg-white m-1 d-flex shadow p-3  text-center justify-content-center card card-outline card-info" >
                    <a href="<?= Url::to(['/quiz/new-quiz']) ?>" value=""  id = "group_modal_button">
                <i class="fa fa-plus-circle text-info"> </i> New Quiz
            </a>
</div> <div class="col-sm-5 text-info bg-white m-1 d-flex shadow p-3  text-center justify-content-center card card-outline card-info" >
            <a href="<?= Url::to(['/quiz/questions-bank']) ?>"  value=""  id = "group_modal_button">
                <i class="fa fa-bank text-info"> </i> Questions Bank
            </a></div>

                        </div>
                           
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### group by  instructor ######################################## -->

                                            <!-- Left col -->
                                            <section class="col-lg-12">


                                                <div class="card-body" >
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                                    <div class="accordion" id="accordion">
                                                        <?php
                                                        
                                                        if(empty($quizzes)){
                                                        
                                                            echo '<div style="width:91%"  class="container border p-2  d-flex justify-content-center p-5"><span class="text-center text-muted text-lg"><i class="fa fa-info-circle text-warning"></i> No Quizzes found</span></div>';
                                                        
                                                        }
                                                        

                                                        foreach($quizzes as $quiz)
                                                        {
                                                        ?>

                                                        <!-- ########################################### GROUPS ######################################## -->

                                                        
                                                           
                                                                   <div class="container d-flex justify-content-center">
                                                                    <div class="card shadow " style="width:91%">
                                                                        <div class="card-header p-2" id="heading1">
                                                                            
                                                                                <div class="row">
                                                                                    <div class="col-sm-8" data-toggle="collapse" data-target="#collapse<?=$quiz->quizID?>" aria-expanded="true" aria-controls="collapse1">
                                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" >
                                                                                        <i class='fa fa-pen'></i> <?=$quiz->quiz_title?>
                                                                                        </button>

                                                                                    </div>
                                                                                    <div class="col-sm-4 text-sm">

                              

                                                                                       
                                                                                            <a href="#" data-toggle="tooltip" data-title="Delete Quiz" class="float-right mr-2 text-danger quizdel" id=<?=$quiz->quizID?>><i class="fa fa-trash fa-1x"></i></a>
                                                                                            <?php
                                                                                            if($quiz->attempt_mode=="massive")
                                                                                            {
                                                                                            ?>
                                                                                            <a href="<?=Url::to(['/quiz/quiz-preview','quiz'=>ClassRoomSecurity::encrypt($quiz->quizID)])?>" data-toggle="tooltip" data-title="View Quiz" class="float-right mr-2"><i class="fa fa-eye fa-1x"></i></a>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                            <a href="<?=Url::to(['/quiz/scores-view','quiz'=>ClassRoomSecurity::encrypt($quiz->quizID)])?>" data-toggle="tooltip" data-title="View Students & Scores" class="float-right mr-2"><i class="fa fa-user-graduate fa-1x"></i></a>
                                                                                            <a href="<?=Url::to(['/quiz/update-quiz','quiz'=>ClassRoomSecurity::encrypt($quiz->quizID)])?>" data-toggle="tooltip" data-title="Update Quiz" class="float-right mr-2"><i class="fa fa-edit fa-1x"></i></a>
                                                            
                                                                                       
                                                                                </div></div>
                                                                            
                                                                       

                                                                        <div id="collapse<?=$quiz->quizID?>" class="collapse" aria-labelledby="heading<?=$quiz->quizID?>" data-parent="#accordion">
                                                                            <!--end of displaying assignment-->
                                                                          
                                                                     
                                                                          <div class="row p-3 d-flex justify-content-center border p-0" style="font-size:11px">
                                                                              <div class="col-sm-2 p-0"><span class="text-bold"><i class="far fa-calendar-plus"></i> Created on</span> <br><?=$quiz->date_created?></div>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="far fa-calendar-check"></i> <?=$quiz->hasStarted()?"Started on":"Starts on"?> </span><br><?=$quiz->start_time?></div>
                                                                              <div class="col-sm-2 p-0 text-center"><span class="text-bold"><i class="far fa-clock"></i> Duration:</span> <br><?=$quiz->duration?> min</div>
                                                                              <?php
                                                                              if($quiz->end_time!=null && $quiz->attempt_mode=="individual")
                                                                              {
                                                                              ?>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="far fa-calendar-minus"></i> <?=$quiz->isExpired()?"Ended on":"Ends on"?> </span><br><?=$quiz->end_time?></div>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                              <div class="col-sm-2 p-0 text-center"><span class="text-bold"><i class="fa fa-check-circle"></i> Questions: </span><br><?=$quiz->total_marks?> </div>
                                                                              <div class="col-sm-2 p-0 text-center"><span class="text-bold"><i class="fas fa-cog"></i> Attempt Mode:</span><br><?=ucfirst($quiz->attempt_mode)?></div>
                                                                          </div>
                                                                          <div class="row"><div class="col-sm-12 text-center text-muted text-sm">by <?=Instructor::findOne($quiz->instructorID)->full_name?></div></div>

                                                                               
                                                                                        </div>
                                                                                            </div>
                                                                                        <!-- -----------------------------group members ---------------------------------------->
                                                                                      
                                                                                    </div>

                                                                                <!--       ---- -----  ---                  another start modal-->
                                                                             

                                                                    </div>
                                                                  
                                                               

                                                                <?php
                                                                  }
                                                                ?>
                                                            </div>
                                                            </div>


                                                      

                                                    </div>
                                                    <!-- ########################################### GROUPS END ######################################## -->
                                              



                                            </section>
                                            <!-- ########################################### group by instructor end ######################################## -->
                                    
                             
                             

                                                           



                               

                                                                           <?php $script = <<<JS
                                                                            $(document).ready(function(){

                                                                                $(document).on('click', '.quizdel', function(){
                                                                                                var quiz = $(this).attr('id');
                                                                                                Swal.fire({
                                                                                            title: 'Delete Quiz?',
                                                                                            text: "You won't be able to revert this!",
                                                                                            icon: 'question',
                                                                                            showCancelButton: true,
                                                                                            confirmButtonColor: '#3085d6',
                                                                                            cancelButtonColor: '#d33',
                                                                                            confirmButtonText: 'Delete !'
                                                                                            }).then((result) => {
                                                                                            if (result.isConfirmed) {

                                                                                            $.ajax({
                                                                                                url:'/quiz/delete-quiz',
                                                                                                method:'post',
                                                                                                async:false,
                                                                                                dataType:'JSON',
                                                                                                data:{quiz:quiz},
                                                                                                success:function(data){
                                                                                                if(data.message=="success"){
                                                                                                    Swal.fire(
                                                                                                        'Deleted !',
                                                                                                        'Quiz Deleted Successfully !',
                                                                                                        'success'
                                                                                            )
                                                                                            setTimeout(function(){
                                                                                                window.location.reload();
                                                                                            }, 100);


                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    Swal.fire(
                                                                                                        'Deleting Failed!',
                                                                                                        data.message,
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




