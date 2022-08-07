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
      <div class="modal-header bg-info p-1">
        <span class="modal-title ml-1" id="exampleModalLabel"><i class="fa fa-edit"></i> Update Program</span>
        
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/updateprog/', 'progid'=> $prog->programCode, 'enctype'=>'multipart/form-data']])?>
        <div class="row">                                
        <div class="col-md-12">
        <?= $form->field($prog, 'prog_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Program Name'])->label(false)?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-4">
        <?= $form->field($prog, 'prog_duration')->textInput(['type'=>'number', 'min'=>0, 'max'=>1000, 'class'=>'form-control form-control-sm', 'placeholder'=>'Program Duration'])->label(false)?>
        
        </div>
        <div class="col-md-4">
        <?= $form->field($prog, 'capacity')->textInput(['type'=>'number', 'min'=>0, 'max'=>1000, 'class'=>'form-control form-control-sm', 'placeholder'=>'Program Capacity'])->label(false)?>
        </div>
        <div class="col-md-4">
        <?= $form->field($prog, 'programCode')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Program Code'])->label(false)?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <?= $form->field($prog, 'departmentID')->dropdownList($departments, ['prompt'=>'--Select Department--'], ['class'=>'form-control form-control-sm'])->label(false) ?>
        </div> 
        </div>
        <div class="row">
      <div class="col-md-12">
      <?= $form->field($prog, 'programCode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      <br>
      <br/>
      </div>
        </div>

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-info float-right ml-2']) ?>
        
      
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