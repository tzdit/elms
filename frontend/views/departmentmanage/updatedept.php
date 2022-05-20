<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;




?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->



<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h4>Update Department</h4></span>
        
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/departmentmanage/update-dept', 'deptid'=> $dept->departmentID, 'enctype'=>'multipart/form-data']])?>
        <div class="row">                                
        <div class="col-md-12">
        <?= $form->field($dept, 'department_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Department Name'])->label(false)?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-12">
        <?= $form->field($dept, 'depart_abbrev')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Department Abbreviation'])->label(false)?>
        </div>
      </div>

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Update', ['class'=>'btn btn-primary float-right ml-2']) ?>
        
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>


<?php 
$script = <<<JS
$(document).ready(function(){
  $("#ProgramList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>