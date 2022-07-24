<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Program;

//$secretKey=Yii::$app->params['app.dataEncryptionKey'];
//$cozzid=Yii::$app->getSecurity()->decryptByPassword($cozzid, $secretKey);

 

?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->


<div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header bg-info p-1">
        <span class="modal-title" id="exampleModalLabel"><i class="fa fa-edit text-info"></i> Update Module</span>
        
      </div>
      
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/course-update-data/', 'cozzid'=> $coz->course_code]])?>
        <div class="row">                                     
        <div class="col-md-12">
        <?= $form->field($coz, 'course_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Module Name'])->label(false)?>
        </div> 
        </div>
  <div class="row">
          <div class="col-md-6">
        <?= $form->field($coz, 'sew')->textInput(['type'=>'text', 'class'=>'form-control form-control-sm', 'placeholder'=>'SEW'])->label(false)?>
        </div>
            <div class="col-md-6">
        <?= $form->field($coz, 'caw')->textInput(['type'=>'text', 'class'=>'form-control form-control-sm', 'placeholder'=>'CAW'])->label(false)?>
        </div>

      </div>

        <div class="row">
        <div class="col-md-6">
        <?= $form->field($coz, 'course_code')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Module Code'])->label(false)?>
        </div>

        <div class="col-md-6">
        <?= $form->field($coz, 'course_credit')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Module Credit'])->label(false)?>
        </div>

       
      </div>

      <div class="row">
        <div class="col-md-6">
        <?= $form->field($coz, 'course_semester')->textInput(['type'=>'number', 'min'=>1, 'max'=>2, 'class'=>'form-control form-control-sm', 'placeholder'=>'Course Semister'])->label(false)?>
        </div>

        <div class="col-md-6">
        <?= $form->field($coz, 'course_duration')->textInput(['type'=>'number', 'min'=>1, 'max'=>5, 'class'=>'form-control form-control-sm', 'placeholder'=>'Course Duration'])->label(false)?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <?= $form->field($coz, 'YOS')->dropdownList(['1'=>'First Year', '2'=>'Second Year', '3'=>'Third Year', '4'=>'Fourth Year', '5'=>'Fifth Year'], ['prompt'=>'--Select YOS --'], ['class'=>'form-control form-control-sm'])->label(false) ?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-12">
        <?= $form->field($coz,'departmentID')->dropdownList($departments,['class'=>'form-control form-control-sm','id'=>'assignstudents2','data-placeholder'=>'Select course Department','style'=>'width:100%'])->label('Department')?>
        </div> 
        </div>

        <div class="row">
      <div class="col-md-12">
      <?= $form->field($coz, 'course_code')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      <br>
      <br/>
      </div>
        </div>

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-edit text-info"></i> Update', ['class'=>'btn btn-info float-right ml-2']) ?>
        
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>


<!-- table for program -->



<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>