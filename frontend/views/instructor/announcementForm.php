<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade " id="announce" tabindex="-1" role="dialog" aria-labelledby="announceLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>New announcement</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/post-announcement','options'=>['enctype'=>'multipart/form-data'],'id'=>'announceform','enableClientValidation' => true])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($announcemodel, 'content')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Your announcement'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Post', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>


