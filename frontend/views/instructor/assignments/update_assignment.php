<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['courseTitle'] ="Update Assignment";
$this->title ="Update assignment";
$this->params['breadcrumbs'] = [
  ['label'=>'class assignments', 'url'=>Url::to(['/instructor/class-assignments', 'cid'=>yii::$app->session->get('ccode')])],
  ['label'=>$this->title]
];

?>
<link href="/css/select2.min.css" rel="stylesheet" />



  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>Update Assignment</h6></span>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/update-assignment?assid='.$ass->assID,'options'=>['enctype'=>'multipart/form-data'],'id'=>'assform'])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assignment Title','value'=>$ass->assName])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Further instructions','value'=>$ass->ass_desc])->label(false)?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
        <?= $form->field($assmodel, 'startDate')->input('date', ['class'=>'form-control form-control form-control-sm','value'=>date($ass->startDate)])->label('Start Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'endDate')->input('date', ['class'=>'form-control form-control form-control-sm','value'=>date($ass->finishDate)])->label('End Date')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'submitMode')->dropdownList(['resubmit'=>'Can resubmit', 'unresubmit'=>'Cant resubmit'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Submission Mode')?>
        </div>
        <div class="col-md-3">
        <?= $form->field($assmodel, 'number_of_questions')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'qnumber','readonly'=>'readonly','value'=>count($ass->assqs)])->label('Number of questions')?>
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
      <div class="row" id="assrow">
      <div class="col-md-12" id="assformatt" style="margin-bottom:10px">
      
      <?= $form->field($assmodel,'assFormat')->textInput(['class'=>'form-control form-control-sm','id'=>'assFormat','value'=>'N/A','readonly'=>'readonly'])->label('Format')?>
      
      </div>
      <?= $form->field($assmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
       </div>
  
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Update', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <?php ActiveForm::end()?>
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

