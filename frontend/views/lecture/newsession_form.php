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
     <span class="modal-title" id="exampleModalLabel"><h7> <i class="fas fa-chalkboard-teacher" aria-hidden="true"></i>Create New Session</h7></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/create-program', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'title')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Session Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'description')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Session Description'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'lectureDate')->input('date',['class'=>'form-control form-control-sm', 'placeholder'=>'Date and Time'])->label(false)?>
        </div> 
        <div class="col-md-6">
        <?= $form->field($model, 'duration')->input('number',['class'=>'form-control form-control-sm', 'placeholder'=>'duration'])->label(false)?>
        </div>
        </div>
        <div class="row text-center" style="margin-bottom:10px"><div class="col-md-12" style="background-color:rgba(255,150,255,.05)"><i class="fa fa-cog"></i> Room Settings</div></div>
        <div class="row">
        <div class="col-md-6">
  
        <span>On</span><?= $form->field($model, 'duration')->input('radio',['class'=>'form-control form-control-sm'])?>
        <?= $form->field($model, 'duration')->input('radio',['class'=>'form-control form-control-sm'])->label(false)?>
   
       
</div>
<div class="col-md-6">
  
  heyhey<?= $form->field($model, 'duration')->input('radio',['class'=>'form-control form-control-sm'])->label(false)?>

 
</div>

        </div>
     

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
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