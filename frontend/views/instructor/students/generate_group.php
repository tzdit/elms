<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>
<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
<<<<<<< HEAD
        <span class="modal-title" id="exampleModalLabel"><h4>Generate new groups</h4></span>
=======
        <span class="modal-title" id="exampleModalLabel"><h6>Generate new groups</h6></span>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/generate-groups']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($studentGroups, 'generationType')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Generation Type: ex: assignment 1 groups'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
<<<<<<< HEAD
        <?= $form->field($studentGroups, 'membersNumber')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Members Number'])->label(false)?>
=======
        <?= $form->field($studentGroups, 'membersNumber')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Group Members Number'])->label(false)?>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
<<<<<<< HEAD
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
=======
        <?= Html::submitButton('Generate', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
