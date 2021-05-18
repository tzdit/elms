<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade" id="createAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="exampleModalLabel">Create New Assignment</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/upload-assignment', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assignment Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Description'])->label(false)?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <?= $form->field($assmodel, 'startDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('Start Date')?>
        </div>
        <div class="col-md-6">
        <?= $form->field($assmodel, 'endDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('End Date')?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
        <?= $form->field($assmodel, 'assType')->dropdownList(['individual'=>'Individual','group'=>'Group Assignemnt'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Assignment Type')?>
        </div>
        <div class="col-md-4">
        <?= $form->field($assmodel, 'submitMode')->dropdownList(['resubmit'=>'Can resubmit', 'unresubmit'=>'Cant resubmit'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Submission Mode')?>
        </div>
        <div class="col-md-4">
        <?= $form->field($assmodel, 'totalMarks')->textInput(['type'=>'number', 'min'=>0, 'max'=>100, 'class'=>'form-control form-control-sm'])->label('Total Marks')?>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
      <div class="custom-file">
      <?= $form->field($assmodel, 'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'customFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
      </div>
      <?= $form->field($assmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md']) ?>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
      <div class="modal-footer">
    
        
      </div>
    </div>
  </div>
</div>
