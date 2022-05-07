<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<link href="/css/select2.min.css" rel="stylesheet" />


<div class="modal fade " id="createAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>Create New Assignment</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/upload-assignment','options'=>['enctype'=>'multipart/form-data'],'id'=>'assform'])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assignment Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Further instructions'])->label(false)?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
        <?= $form->field($assmodel, 'endDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('End Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'endTime')->input('time', ['class'=>'form-control form-control form-control-sm'])->label('End Time')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'submitMode')->dropdownList(['resubmit'=>'Resubmit', 'unresubmit'=>'Can\'t resubmit'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Submission Mode')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'number_of_questions')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'qnumber'])->label('Number of questions')?>
        </div>
      </div>
      <div class="row" style="border:solid 1px #ccc;margin-bottom:1%">
        <div class="col-md-9 questions" id="questions">
        
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'totalMarks')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'totm'])->label('Total Marks')?>
        </div>
      </div>
      <div class="row" id="asstypearea" style="border:solid 1px #ccc;margin-bottom:1%">
        <div class="col-md-4">
        <?= $form->field($assmodel, 'assType')->dropdownList(['allstudents'=>'All students','allgroups'=>'All groups','groups'=>'Chosen groups','students'=>'Chosen students'], ['class'=>'form-control form-control-sm','id'=>'asstype', 'prompt'=>'--select--'])->label('Assigned to')?>
        </div>
       
      </div>
      <div class="row">
      <div class="col-md-12">
     
      <?= $form->field($assmodel,'assFormat')->dropdownList(['typed'=>'type','file'=>'Attach file'], ['class'=>'form-control form-control-sm','id'=>'assFormat', 'prompt'=>'--choose format--'])->label('Type/Attach file')?>
  
     </div>
      </div>
      <div class="row" id="assrow">
      <div class="col-md-12" id="assformatt" style="margin-bottom:10px">
      
      
      
      </div>
      <?= $form->field($assmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
       </div>
  
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Create', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
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

