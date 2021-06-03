<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade" id="createLabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLabel">Create New Lab</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/upload-lab', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($labmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Lab Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($labmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Description'])->label(false)?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <?= $form->field($labmodel, 'startDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('Start Date')?>
        </div>
        <div class="col-md-6">
        <?= $form->field($labmodel, 'endDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('End Date')?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
        <?= $form->field($labmodel, 'assType')->dropdownList(['individual'=>'Individual','group'=>'Group Assignemnt'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Assignment Type')?>
        </div>
        <div class="col-md-4">
        <?= $form->field($labmodel, 'submitMode')->dropdownList(['resubmit'=>'Can resubmit', 'unresubmit'=>'Cant resubmit'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Submission Mode')?>
        </div>
        <div class="col-md-4">
        <?= $form->field($labmodel, 'totalMarks')->textInput(['type'=>'number', 'min'=>0, 'max'=>100, 'class'=>'form-control form-control-sm'])->label('Total Marks')?>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <div class="custom-file">
      <?= $form->field($labmodel, 'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'customFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
      </div>
      <?= $form->field($labmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
