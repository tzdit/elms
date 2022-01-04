<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use frontend\models\UploadMaterial;
use yii\helpers\Url;
use common\models\Module;
use frontend\models\ClassRoomSecurity;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\file\FileInput;
use yii\widgets\Pjax;


AppAsset::register($this);
?>
<?php 
$ccode=yii::$app->session->get('ccode');

$moduleID=ClassRoomSecurity::decrypt($module);
$this->params['courseTitle'] ="<i class='fa fa-book-open'></i> Module: <span class='text-sm'>".Module::findOne($moduleID)->moduleName."</span>";
$this->title =Module::findOne($moduleID)->moduleName;
$this->params['breadcrumbs'] = [
  ['label'=>'class Dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>ClassRoomSecurity::encrypt($ccode)])],
  ['label'=>'class materials', 'url'=>Url::to(['/instructor/class-materials', 'cid'=>ClassRoomSecurity::encrypt($ccode)])],
  ['label'=>'upload material']
];
?>
<div class="container col d-flex justify-content-center">
<div class="card" style="width:80%">
      <div class="card-header bg-primary pt-2 pb-2">
        <span><h6><i class="fas fa-external-link-alt"></i> Share External Material Link</h6></span>
      </div>
      <div class="card-body justify-content-center">
    
      <?php 
       Pjax::begin(['id'=>'materialform','timeout'=>'3000']);
      $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/share-link','module'=>$module]]);
      ?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'title')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Material Title'])->label(false)?>
        </div> 
        </div>
      <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'fileName')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Paste you link here'])->label(false)?>
       
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?=Html::submitButton('<i class="fa fa-plus-circle"></i> Share', ['class' => 'btn btn-primary float-right']) ?>
        </div> 
        </div>
      <div class="row">
      <div class="col-md-12 p-0">
      <?php
   Pjax::begin(['id'=>'studloader1']);
   ?>


   <div class="overlay mt-0" id="studloading1" style="background-color:rgba(0,0,255,.1);color:#fff;display:none;position:absolute;height:75%;width:100%">
     <i class="fas fa-2x fa-sync-alt fa-spin text-white font-weight-bold"></i> Uploading...
   </div>
   <?php

   Pjax::end();
?>

      
       </div>
       </div>
     
      
        <?php 
        ActiveForm::end();
        Pjax::end();
        ?>
        


        </div>
    </div>
    </div>
  </div>
</div>
</div>
<?php
$script = <<<JS
    $('document').ready(function(){

      $('#materialform').on('pjax:send', function() {
       $('#studloading1').show();
       })
      $('#materialform').on('pjax:complete', function() {
      $('#studloading1').hide();
            })
        })

    JS;
    $this->registerJs($script);
