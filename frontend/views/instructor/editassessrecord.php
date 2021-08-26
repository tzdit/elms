<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
<<<<<<< HEAD
use frontend\models\AddAssessRecord;
=======
use yii\helpers\Url;
use frontend\models\AddAssessRecord;
use common\models\StudentExtAssess;
$secretKey=Yii::$app->params['app.dataEncryptionKey'];
$recordid=Yii::$app->getSecurity()->decryptByPassword($recordid, $secretKey);
$this->params['courseTitle'] =StudentExtAssess::findOne($recordid)->assess->title;
$this->title = 'Edit assessment record';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/instructor/classwork', 'cid'=>yii::$app->session->get("ccode")])],
  ['label'=>$this->title]
];

>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
$assessmodel=new AddAssessRecord();
?>
<div class="row justify-content-center">
<div class="card shadow " style="width:50%">
  <div class="card-header p-2 shadow bg-primary">
        <span id="exampleModalLabel"><h6 class="text-white">Edit record</h6></span>
  </div>
      <div class="card-body">
<<<<<<< HEAD
=======
        <?php
              //$secretKey=Yii::$app->params['app.dataEncryptionKey'];
              //$recordid=Yii::$app->getSecurity()->encryptByPassword($recordid, $secretKey);
        ?>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
      <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/edit-ext-assrecord?recordid='.$recordid,'options'=>['enctype'=>'multipart/form-data'],'id'=>'assform','enableClientValidation' => true])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assessmodel, 'regno')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'qnumber','value'=>$regno])->label('Registration number')?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <?= $form->field($assessmodel, 'score')->textInput(['type'=>'text','class'=>'form-control form-control-sm','id'=>'totm','value'=>$score])->label('Score')?>
        </div>
</div>
</div>
<div class="card-footer p-2">
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Update', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
    </div>
 


