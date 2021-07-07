<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<link href="/css/select2.min.css" rel="stylesheet" />


<div class="modal fade " id="createLabModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h4>Create New Lab Assignment</h4></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/upload-lab','options'=>['enctype'=>'multipart/form-data'],'id'=>'labform','enableClientValidation' => true])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($labmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assignment Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($labmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Further instructions'])->label(false)?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
        <?= $form->field($labmodel, 'startDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('Start Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($labmodel, 'endDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('End Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($labmodel, 'submitMode')->dropdownList(['resubmit'=>'Can resubmit', 'unresubmit'=>'Cant resubmit'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Submission Mode')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($labmodel, 'number_of_questions')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'labqnumber'])->label('Number of questions')?>
        </div>
      </div>
      <div class="row" style="border:solid 1px #ccc;margin-bottom:1%">
        <div class="col-md-9 questions" id="labquestions">
        
        </div>
        <div class="col-md-3">
        <?= $form->field($labmodel, 'totalMarks')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'labtotm'])->label('Total Marks')?>
        </div>
      </div>
      <div class="row" id="labtypearea" style="border:solid 1px #ccc;margin-bottom:1%">
        <div class="col-md-4">
        <?= $form->field($labmodel, 'assType')->dropdownList(['allstudents'=>'All students','allgroups'=>'All groups','groups'=>'Chosen groups','students'=>'Chosen students'], ['class'=>'form-control form-control-sm','id'=>'labtype', 'prompt'=>'--select--'])->label('Assigned to')?>
        </div>
       
      </div>
      <div class="row">
      <div class="col-md-12">
     
      <?= $form->field($labmodel,'assFormat')->dropdownList(['typed'=>'type','file'=>'Attach file'], ['class'=>'form-control form-control-sm','id'=>'labFormat', 'prompt'=>'--choose format--'])->label('Type/Attach file')?>
  
     </div>
      </div>
      <div class="row" id="labrow">
      <div class="col-md-12" id="labformatt" style="margin-bottom:10px">
      
      
      
      </div>
      <?= $form->field($labmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
       </div>
  
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Create lab', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
<?php 
$this->registerCssFile('@web/css/adminlte.min.css');
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-lab.js',
  ['depends' => 'yii\web\JqueryAsset'],

);

?>

