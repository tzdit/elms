<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use common\models\LiveLecture;
use frontend\models\LectureRoom;
use yii\helpers\ArrayHelper;




?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->


<div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary pt-1 pb-1">
     <span class="modal-title" id="exampleModalLabel"><h7> <i class="fa fa-play-circle"></i> Start Session</h7></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
      $lectures=(new LectureRoom)->findLectureSchedule();
      $lectures=ArrayHelper::map($lectures,"lectureID","title");
      $form = ActiveForm::begin(['method'=>'post', 'action'=>['/lecture/start-session']])
      ?>
      <div class="row">
        <div class="col-md-12">
  
       
        <?= $form->field($model, 'lecture')->dropDownList($lectures,['class'=>'form-control form-control-sm', 'prompt'=>'--Choose Session--'])->label(false)?>
       
        </div>
        </div>
        <div class="row">
          <div class="col-sm-12 text-center mb-2" style="color:rgba(70,100,255,.6)"><i class="fa fa-cog"></i> Session Policies</div>
        </div>
        <div class="row">
        <div class="col-md-12">
  
       
        <?= $form->field($model, 'lockSettingsDisablePublicChat')->dropDownList(['on'=>'On','off'=>'Off'],['class'=>'form-control form-control-sm', 'prompt'=>'--Public Chat--'])->label(false)?>
       
        </div>
        </div>

        <div class="row">
        <div class="col-md-12">
  
       
        <?= $form->field($model, 'lockSettingsDisablePrivateChat')->dropDownList(['on'=>'On','off'=>'Off'],['class'=>'form-control form-control-sm', 'prompt'=>'--Private Chat--'])->label(false)?>
       
        </div>


        </div>

        <div class="row">
        <div class="col-md-12">
  
       
        <?= $form->field($model, 'webcamsOnlyForModerator')->dropDownList(['on'=>'On','off'=>'Off'],['class'=>'form-control form-control-sm', 'prompt'=>'--WebCams Only For Instructor--'])->label(false)?>
       
        </div>


        </div>

        <div class="row">
        <div class="col-md-12">
  
       
        <?= $form->field($model, 'allowStartStopRecording')->dropDownList(['on'=>'On','off'=>'Off'],['class'=>'form-control form-control-sm', 'prompt'=>'--Allow Start-stop Recording--'])->label(false)?>
       
        </div>


        </div>

        <div class="row">
        <div class="col-md-12">
  
       
        <?= $form->field($model, 'autoStartRecording')->dropDownList(['on'=>'On','off'=>'Off'],['class'=>'form-control form-control-sm', 'prompt'=>'--AutoStart Recording--'])->label(false)?>
       
        </div>


        </div>
     

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-play-circle"></i> Start', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
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