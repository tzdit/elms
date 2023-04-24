<?php
   use yii\bootstrap4\ActiveForm;
   use yii\helpers\Html;
   use common\models\Course;
   use yii\helpers\ArrayHelper;
   use common\models\InstructorCourse;


   $courses=Course::find()->all();
   $courses=ArrayHelper::map($courses,'course_code',function($model){
    return "[".$model->course_code."] ".$model->course_name;
   },'departmentdesc');
   $model=new InstructorCourse;
?>


<div class="modal fade" id="courseassignmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info p-1 pl-2">
        <span class="modal-title" id="exampleModalLabel"><i class='fa fa-plus-circle'></i> Assign Modules</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post'])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'course_code')->dropdownList($courses,['class'=>'form-control', 'prompt'=>'--Choose Modules--'])->label(false)?>
        </div> 
        </div>

       
     
      </div>     
        <div class="row">
        <div class="col-md-12 p-3">
        <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Assign', ['class'=>'btn btn-info btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>