<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title " id="exampleModalLabel"><h3>Update Assignment</h3></span>
       
         
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/update/', 'id'=> $ass->assID, 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($ass, 'assName')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Assignment Title'])->label('Assignment Name')?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($ass, 'ass_desc')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Description'])->label('Assignment Description')?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <?= $form->field($ass, 'total_marks')->textInput(['type'=>'number', 'min'=>0, 'max'=>100, 'class'=>'form-control form-control-sm'])->label('Total Marks')?>
        </div>
        <div class="col-md-6">
        <?= $form->field($ass, 'finishDate')->input('date', ['class'=>'form-control form-control form-control-sm'])->label('Expire Date')?>
        </div>
      </div>
      
      <div class="row">
      <div class="col-md-12">
      <?= $form->field($ass, 'course_code')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      <br>
      <br/>
      </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Update', ['class'=>'btn btn-primary float-right ml-2']) ?>
        
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>

