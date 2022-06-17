<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="Update";

$this->params['courseTitle']="<i class='fa fa-edit'></i> Update Department";

$this->params['breadcrumbs'] = [
  ['label'=>'Departments', 'url'=>Url::to(['/departmentmanage/index'])],
  ['label'=>$this->title]
];

?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->



<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Update Department</span>
        
      </div>
      <div class="modal-body " style="font-size:11px">
      <?php $form = ActiveForm::begin(['method'=>'post'])?>
        <div class="row">                                
        <div class="col-md-12">
        <?= $form->field($dept, 'department_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Department Name'])->label('Department Name')?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-12">
        <?= $form->field($dept, 'depart_abbrev')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Department Abbreviation'])->label('Department Abbreviation')?>
        </div>
      </div>
      <div class="row">
                    <div class="col-md-12">
                    <?= $form->field($dept, 'collegeID')->dropDownList($colleges,['prompt' => '--college--'])->label(false) ?>
                    
                    </div>
                </div>
              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-default float-right ml-2']) ?>
        
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