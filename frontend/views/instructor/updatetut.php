<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use common\models\Assignment;
use yii\helpers\Url;
use frontend\models\ClassRoomSecurity;

$this->params['courseTitle'] ='<i class="fa fa-edit"></i> '.Assignment::findOne(ClassRoomSecurity::decrypt($id))->assName;
$this->title = 'Update tutorial';
$this->params['breadcrumbs'] = [
  ['label'=>'Class Tutorials', 'url'=>Url::to(['/instructor/class-tutorials', 'cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get('ccode'))])],
  ['label'=>$this->title]
];
?>

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info pt-1 pb-1 ">
        <span class="modal-title " id="exampleModalLabel"><i class="fa fa-edit"></i> Update Tutorial</span>
       
         
        </button>
      </div>
      <div class="modal-body text-sm">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/updatetut/', 'id'=>ClassRoomSecurity::encrypt($tut->assID), 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($tut, 'assName')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Tutorial Title'])->label('Tutorial Title')?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($tut, 'ass_desc')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Description'])->label('Tutorial Description')?>
        </div>
        </div>
      
      <div class="row">
      <div class="col-md-12">
      <?= $form->field($tut, 'course_code')->hiddenInput(['class'=>'form-control form-control-sm'])->label(false)?>
      </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-edit"></i> Update', ['class'=>'btn btn-info btn-sm float-right ml-2']) ?>
        
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>

