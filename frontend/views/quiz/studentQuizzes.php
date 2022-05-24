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
$this->params['courseTitle'] ='<img src="/img/quiz.png" height="25px" width="25px"/> Quizzes';
$this->title = 'Quizzes';
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

                <section class="col-lg-12">
                
                           
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### group by  instructor ######################################## -->

                                            <!-- Left col -->
                                            <section class="col-lg-12">


                                                <div class="card-body" >
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                                    <div class="accordion" id="accordion">
                                                        <?php
                                                        
                                                        if(empty($quizzes)){
                                                        
                                                            echo '<div style="width:91%"  class="container border p-2  d-flex justify-content-center p-5"><span class="text-center text-muted text-lg"><i class="fa fa-info-circle"></i> No Quizzes found</span></div>';
                                                        
                                                        }
                                                        

                                                        foreach($quizzes as $quiz)
                                                        {
                                                        ?>

                                                        <!-- ########################################### GROUPS ######################################## -->

                                                        
                                                           
                                                                   <div class="container-fluid">
                                                                    <div class="card shadow " >
                                                                        <div class="card-header p-2" id="heading1">
                                                                            
                                                                                <div class="row">
                                                                                    <div class="col-sm-8" data-toggle="collapse" data-target="#collapse<?=$quiz->quizID?>" aria-expanded="true" aria-controls="collapse1">
                                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" >
                                                                                        <img src="/img/quiz.png" height="25px" width="25px"/> <?=$quiz->quiz_title?>
                                                                                        </button>

                                                                                    </div>
                                                                                    <div class="col-sm-4 text-sm">

                              

                                                                                       
                                                                                       
                                                                                            <?php
                                                            
                                                                                            if(!$quiz->isExpired())
                                                                                            {
                                                                                                
                                                                                            ?>
                                                                                            <a href="<?=Url::to(['/quiz/quiz-take','quiz'=>ClassRoomSecurity::encrypt($quiz->quizID)])?>" data-toggle="tooltip" data-title="Take Quiz" class="float-right mr-2 btn btn-default shadow text-primary"><i class="fa fa-pen fa-1x"></i> Take Quiz</a>
                                                                                            <?php
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                            ?>
                                                                                             <a class="float-right mr-2  border p-2 text-danger"><i class="fa fa-exclamation-triangle fa-1x"></i> Expired</a>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                          
                                                            
                                                                                       
                                                                                </div></div>
                                                                            
                                                                       

                                                                        <div id="collapse<?=$quiz->quizID?>" class="collapse" aria-labelledby="heading<?=$quiz->quizID?>" data-parent="#accordion">
                                                                          
                                                                          <?php if($quiz->getScore()!=null){?>
                                                                             <div class="row d-flex justify-content-center">
                                                                                 <div class="col-sm-2">
                                                                                  <div class="row shadow m-2 p-2">
                                                                                 <div class="col-sm-12   border-bottom text-center ">
                                                                                     <?php if((($quiz->getScore()*100)/$quiz->total_marks)<40){ ?>
                                                                                   <span class="text-danger"><?=$quiz->getScore()?></span>
                                                                                   <?php }else{ ?>
                                                                                    <span class="text-success"><?=$quiz->getScore()?></span>

                                                                                    <?php } ?>
                                                                                 </div>
                                                                                 <div class="col-sm-12 text-center">
                                                                                  <?=$quiz->total_marks?>
                                                                                 </div>
                                                                          </div>
                                                                              </div>
                                                                          </div>
                                                                          <?php }?>
                                                                          <div class="row p-3 d-flex justify-content-center border p-0" style="font-size:11px">
                                                                              <div class="col-sm-2 p-0"><span class="text-bold"><i class="far fa-calendar-plus"></i> Created on</span> <br><?=$quiz->date_created?></div>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="far fa-calendar-check"></i> <?=$quiz->hasStarted()?"Started on":"Starts on"?></span><br><?=$quiz->start_time?></div>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="far fa-clock"></i> Duration:</span> <br><?=$quiz->duration?> min</div>
                                                                              <?php
                                                                              if($quiz->end_time!=null && $quiz->attempt_mode=="individual")
                                                                              {
                                                                              ?>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="far fa-calendar-minus"></i> <?=$quiz->isExpired()?"Ended on":"Ends on"?> </span><br><?=$quiz->end_time?></div>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="fa fa-check-circle"></i> Questions: </span><br><?=$quiz->total_marks?> </div>
                                                                              <div class="col-sm-2 p-0 "><span class="text-bold"><i class="fas fa-cog"></i> Attempt Mode:</span><br><?=ucfirst($quiz->attempt_mode)?></div>
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




