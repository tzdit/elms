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



/* @var $this yii\web\View */
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] ="<i class='fa fa-plus-circle text-info'></i> New Quiz";
$this->title = 'New Quiz';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Quizes', 'url'=>Url::to(['class-quizes','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->
       
        <div class="container-fluid">
           <div class="card shadow">
              <div class="card-body">
              <form action="/quiz/create-quiz" method="post">
              <div class="row">
                <div class="col-sm-3">
                 <input type="text" name="quizName" class="form-control" placeholder="Quiz title, ex: quiz one, test 1" required></input>
                 </div>
                   <div class="col-sm-3">
                 <select  name="attemptMode" class="form-control attempt" required>
                   <option value="" selected disabled hidden>--Attempt Mode--</option>
                   <option value="massive">Massive Attempt (All Students At The Same Time)</option>
                   <option value="individual">Individual Attempt (Individual Random questions within a deadline)</option>
                 </select>
                 </div>
                 <div class="col-sm-3">
                 <input type="text" name="StartingDate" placeholder="Starting Date" onmouseover="(this.type='date')"  onfocus="(this.type='date')" onblur="(this.type='text')"  class="form-control" required></input>
                
                 </div>
                 <div class="col-sm-3">
                 <input type="text" name="StartingTime" placeholder="Starting Time" onmouseover="(this.type='time')"  onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control float-left " required></input>
                 </div>
               </div>
               <div class="row mt-1">
                 <div class="col-sm-3">
                 <input type="text" name="DeadlineDate" placeholder="Deadline Date" onmouseover="(this.type='date')"  onfocus="(this.type='date')" onblur="(this.type='text')"  class="form-control deadlinedate" required></input>
                 </div>
                 <div class="col-sm-3">
                 <input type="text" name="DeadlineTime" placeholder="Deadline Time" onmouseover="(this.type='time')" onfocus="(this.type='time')" onblur="(this.type='text')" class="form-control float-left deadlinetime" required></input>
                 </div>
                 <div class="col-sm-3">
                 <div class="row pr-1 pl-1">
                   <div class="col-sm p-0 mr-1">
                 <input type="text" name="duration" class="form-control" placeholder="Duration(min)" required></input>
                 </div>
                 <div class="col-sm p-0  ml-1">
                 <input type="text" name="numquestions" class="form-control numq" placeholder="no. questions" required></input>
                 </div>
                 </div>
                 </div>

                 <div class="col-sm-3  text-sm p-3">
                 <input type="checkbox" name="viewAnswers" class="text-muted" data-toggle="tooltip" data-title="N/A" disabled><span class="text-muted">View Answers After Submitting</span></input>
                 </div>
               </div>
               
               </div>

           </div>
          
      
        <div class="row p-2 ">
           <div class="col-sm-7 shadow bg-white p-5" style="max-height:500px!important;overflow:auto">
           <div class="container mb-4 text-lg text-muted border-bottom">Chosen Questions Appear Here</div>
             <div class="container chosenquestions">
              
             </div>
         
          </div>
           <div class="col-sm-5 p-3 m-0 bg-white " style="max-height:500px!important;overflow:auto">
             <?=$this->render("/quiz/questionsBank2")?>



           </div>
         </div>
         <div class="row mb-2 shadow">
           <div class="col-sm-12 bg-white d-flex justify-content-center p-3 ">
          <button type="submit" class="btn btn-default btn-md bg-info shadow"><i class="fa fa-save"></i> Save Quiz</button>
          </div>
         </div>
        </div>
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
</form>
    </div>
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
$('body').on('change','.attempt',function(){

if($(this).val()=="individual")
{
 $('.chooseq').prop('disabled','disabled');
 $('.deadlinedate').prop('disabled','');
  $('.deadlinetime').prop('disabled','');
  $('.numq').prop('disabled','');
  $('.chosenquestions').html("<div class='text-center text-lg text-muted mt-5 p-5'><i class='fa fa-info-circle'></i>Random Questions !</div>");
  Swal.fire(
    "Tip !",
    "This type will allow a student to take the quiz at his favourable time within a specified deadline, students will get individual quiz/test version with randomly selected questions from your questions bank. Make sure you have enough questions in your bank to avoid some questions or versions repeating several times leading to cheating during the quiz/test.",
    'info'
  )
}
else
{
  $('.chosenquestions').html("");
  $('.chooseq').prop('disabled','');
  $('.deadlinedate').prop('disabled','disabled');
  $('.deadlinetime').prop('disabled','disabled');
  $('.numq').prop('disabled','disabled');
  Swal.fire(
    "Tip !",
    "This type will constrain students to take the quiz/test all at once and at the same time, students have the same version of quiz/test as per your definition. Mind our server limit! This server may slow down in case of very big classes !",
    'info'
  )

}

});
  
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




