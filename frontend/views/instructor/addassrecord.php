<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade " id="addrecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>Add new record</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/add-assess-record?assessid='.$assessid,'options'=>['enctype'=>'multipart/form-data'],'id'=>'assform','enableClientValidation' => true])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assessmodel, 'regno')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'qnumber'])->label('Registration number')?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <?= $form->field($assessmodel, 'score')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'totm'])->label('Score')?>
        </div>
</div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Add', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>


