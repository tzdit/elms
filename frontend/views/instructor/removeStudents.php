<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use common\models\Program;
use yii\helpers\ArrayHelper;
?>


<?php 
$programs=Program::find()->all();
$programs=ArrayHelper::map($programs,'programCode','prog_name'); 
$levels=[0=>'All',1=>'First Year',2=>'Second Year',3=>'Third Year',4=>'Fourth Year',5=>'Fifthy Year'];
?>
<div class="modal fade remstudents" id="removestudents" tabindex="-1" role="dialog" aria-labelledby="remModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><h6><i class="fa fa-graduation-cap"></i> Remove Students</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/remove-students','id'=>'studentsremform'])?>
      <div class="row">
      <div class="col-md-12">
     
      <?= $form->field($removestudentsmodel,'programs[]')->dropdownList($removestudentsmodel->getAssignedPrograms(),['class'=>'form-control form-control-sm','id'=>'remstudents','data-placeholder'=>'--Search or Select Programs--','multiple'=>'multiple','style'=>'width:100%'])->label('Programs')?>
      
      <?= $form->field($removestudentsmodel,'level')->dropdownList($levels,['class'=>'form-control form-control-sm','id'=>'levels','prompt'=>'--select level--','style'=>'width:100%'])->label('Level')?>
  
     </div>
      </div>
    
       
  
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-floppy-o" aria-hidden="true"></i>
Save changes', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>


    </div>



  </div>
</div>

<?php 




?>


