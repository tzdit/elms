<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade " id="external_assess" tabindex="-1" role="dialog" aria-labelledby="assessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>Upload new external assessment</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/import-external-assessment','options'=>['enctype'=>'multipart/form-data'],'id'=>'assessform','enableClientValidation' => true])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assessmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assessment Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assessmodel, 'totalMarks')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Maximum scoring'])->label(false)?>
        </div> 
        </div>
      <div class="row">
      <div class="col-md-12">
      <div class="custom-file">
      <?= $form->field($assessmodel,'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'myFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
      </div>
      </div>
        </div>
        <div class="modal-footer">
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Upload', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
<?php 
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>

