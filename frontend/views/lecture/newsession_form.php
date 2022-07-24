<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;




?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->


<div class="modal fade" id="lectureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary pt-1 pb-1">
     <span class="modal-title" id="exampleModalLabel"><h7> <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Create New Session</h7></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/lecture/new-session']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'title')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Session Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Session Description','rows'=>3])->label(false)?>
        </div> 
        </div>
        <div class="row" style="font-size:11px">
        <div class="col-md-4">
        <?= $form->field($model, 'lectureDate')->input('date',['class'=>'form-control form-control-sm', 'prompt'=>'Date and Time'])->label('Date')?>
        </div> 
        <div class="col-md-4">
        <?= $form->field($model, 'lectureTime')->input('time',['class'=>'form-control form-control-sm', 'prompt'=>'Date and Time'])->label('Time')?>
        </div> 
        <div class="col-md-4">
        <?= $form->field($model, 'duration')->input('number',['class'=>'form-control form-control-sm', 'placeholder'=>'duration'])->label('Duration (min)')?>
        </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Create', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>


<?php 
$script = <<<JS
$(document).ready(function(){
 

})




JS;
$this->registerJs($script);
?>