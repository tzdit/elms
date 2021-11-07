<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<!-- ################################################# -->
<div class="modal fade" id="AssignCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <span class="modal-title" id="exampleModalLabel"><h4>Assign Programs To a Course</h4></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/create-course', 'enctype'=>'multipart/form-data']])?>

        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model,'programs[]')->dropdownList($programs,['class'=>'form-control form-control-sm','id'=>'assignstudents','data-placeholder'=>'Select degree Programs','multiple'=>'multiple','style'=>'width:100%'])->label('Degree Programs')?>
        </div> 
        </div>

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>


<!-- ################################################## -->
 
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

<?php 
$script = <<<JS
$(document).ready(function(){
  $("#ProgramList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>