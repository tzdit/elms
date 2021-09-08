<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade" id="createTutorialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>Create New Tutorial</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/upload-tutorial', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($tutmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Tutorial Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
<<<<<<< HEAD
        <?= $form->field($tutmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Description'])->label(false)?>
=======
        <?= $form->field($tutmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Hints'])->label(false)?>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        </div>
        </div>
        
      <div class="row">
      <div class="col-md-12">
      <div class="custom-file">
<<<<<<< HEAD
      <?= $form->field($tutmodel, 'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'customFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
=======
      <?= $form->field($tutmodel, 'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
      </div>
      <?= $form->field($tutmodel, 'ccode')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      </div>
        </div>
        <div class="row">
        <div class="col-md-12">
<<<<<<< HEAD
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
=======
        <?= Html::submitButton('Create', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
