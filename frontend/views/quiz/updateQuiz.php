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
$this->params['courseTitle'] ="<i class='fa fa-edit'></i> Update Quiz";
$this->title = 'Update Quiz';
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
              <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>['/quiz/update-quiz','quiz'=>ClassRoomSecurity::encrypt($quiz->quizID)],'id'=>'form'])?>
              <div class="row">
                <div class="col-sm-3">
                 <?= $form->field($quiz, 'quiz_title')->textInput(['class'=>'form-control', 'placeholder'=>'Quiz title, ex: quiz one, test 1'])->label(false)?>
                 </div>
                   <div class="col-sm-3">
                   <?= $form->field($quiz, 'attempt_mode')->dropdownList(['massive'=>'Massive Attempt (All Students At The Same Time)', 'individual'=>'Individual Attempt (Individual Random questions within a deadline)'], ['class'=>'form-control attempt', 'prompt'=>'--Attempt Mode--'])->label(false)?>
                 </div>
                 <div class="col-sm-3">
                 <?= $form->field($quiz, 'startdate')->textInput(['class'=>'form-control','placeholder'=>'Starting Date','onmouseover'=>"(this.type='date')",'onblur'=>"(this.type='text')",'required'=>'required' ])->label(false)?>
  
                 </div>
                 <div class="col-sm-3">
                 <?= $form->field($quiz, 'starttime')->textInput(['class'=>'form-control float-left','placeholder'=>'Starting Time','onmouseover'=>"(this.type='time')",'onblur'=>"(this.type='text')",'required'=>'required' ])->label(false)?>
                 </div>
               </div>
               <div class="row mt-1">
                 <div class="col-sm-3">
                 <?= $form->field($quiz, 'enddate')->textInput(['class'=>'form-control deadlinedate','placeholder'=>'Deadline date','onmouseover'=>"(this.type='date')",'onfocus'=>"(this.type='date')",'onblur'=>"(this.type='text')",'required'=>'required' ])->label(false)?>
     
                 </div>
                 <div class="col-sm-3">
                 <?= $form->field($quiz, 'endtime')->textInput(['class'=>'form-control float-left deadlinetime','placeholder'=>'Deadline Time','onmouseover'=>"(this.type='time')",'onfocus'=>"(this.type='time')",'onblur'=>"(this.type='text')",'required'=>'required' ])->label(false)?>
                 </div>
                 <div class="col-sm-3">
                 <div class="row pr-1 pl-1">
                   <div class="col-sm p-0 mr-1">
                   <?= $form->field($quiz, 'duration')->textInput(['class'=>'form-control', 'placeholder'=>'Duration(min)'])->label(false)?>
                 </div>
                 <div class="col-sm p-0  ml-1">
                 <?= $form->field($quiz, 'num_questions')->textInput(['class'=>'form-control numq', 'placeholder'=>'no. questions','required'=>'required'])->label(false)?>
                 </div>
                 </div>
                 </div>
               </div>
               
               
               <?= Html::submitButton('<i class="fa fa-save"></i> Update Quiz', ['class'=>'btn btn-default btn-sm text-primary shadow float-right m-3 col-sm-3 p-2']) ?>
           </div>
           </div>
          
       
           <?php ActiveForm::end()?>
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

if($('.attempt').val()=="massive")
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
else
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




