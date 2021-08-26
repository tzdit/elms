<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
<<<<<<< HEAD
=======
use common\models\Assignment;
use yii\helpers\Url;

$this->params['courseTitle'] =Assignment::findOne($_GET['id'])->assName." tutorial";
$this->title = 'Update tutorial';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/instructor/classwork', 'cid'=>yii::$app->session->get('ccode')])],
  ['label'=>$this->title]
];
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
?>

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title " id="exampleModalLabel"><h3>Update Tutorial</h3></span>
       
         
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/updatetut/', 'id'=> $tut->assID, 'enctype'=>'multipart/form-data']])?>
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

