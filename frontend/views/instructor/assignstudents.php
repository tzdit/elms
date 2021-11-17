<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use common\models\Program;
use yii\helpers\ArrayHelper;
?>


<?php 
$programs=Program::find()->all();
$programs=ArrayHelper::map($programs,'programCode','prog_name'); 
$levels=[1=>'First Year',2=>'Second Year',3=>'Third Year',4=>'Fourth Year',5=>'Fifthy Year'];
?>
<div class="modal fade " id="Addstudents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h6>Add Students</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/add-students','id'=>'studentsaddform'])?>
      <div class="row">
      <div class="col-md-12">
     
      <?= $form->field($assignstudentsmodel,'programs[]')->dropdownList($programs,['class'=>'form-control form-control-sm','id'=>'assignstudents','data-placeholder'=>'--Select degree Programs--','multiple'=>'multiple','style'=>'width:100%'])->label('Degree Programs')?>
      
      <?= $form->field($assignstudentsmodel,'level')->dropdownList($levels,['class'=>'form-control form-control-sm','id'=>'levels','prompt'=>'--select level--','style'=>'width:100%'])->label('Level')?>
  
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
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);

?>


