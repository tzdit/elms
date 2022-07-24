<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\Pjax;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<div class="modal fade" id="createTutorialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info pt-2 pb-1">
        <span class="modal-title" id="exampleModalLabel"><h6><i class="fa fa-plus-circle"></i> New Tutorial</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <?php 
      Pjax::begin(['id'=>'tutorialform','timeout'=>'3000']);
      $form = ActiveForm::begin(['method'=>'post','options' => ['data-pjax' => true ], 'action'=>['/instructor/upload-tutorial', 'enctype'=>'multipart/form-data']]);
      ?>
      <?= $form->errorSummary($tutmodel) ?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($tutmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Tutorial Title'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($tutmodel, 'description')->textarea(['class'=>'form-control form-control-sm', 'placeholder'=>'Hints'])->label(false)?>
        </div>
        </div>
        
      <div class="row">
      <div class="col-md-12">
      <?php
   Pjax::begin(['id'=>'studloader1']);
   ?>


   <div class="overlay mt-0" id="studloading1" style="background-color:rgba(0,0,255,.1);color:#fff;display:none;position:absolute;height:75%;width:100%">
     <i class="fas fa-2x fa-sync-alt fa-spin text-white font-weight-bold"></i> Uploading...
   </div>
   <?php

   Pjax::end();
?>
      <?=

$form->field($tutmodel, 'assFile')->widget(FileInput::classname(),[
   'options' => ['multiple' => false],
    'pluginOptions' => [
        'showUpload' => true,
        'browseLabel' => 'Browse',
        'removeLabel' => 'Remove',
        'uploadClass' => ' mx-2 btn btn-primary',
        'browseClass' => 'btn btn-primary float-right',
        'removeClass' => 'btn btn-danger',
        'removeIcon'=>'<i class="fa fa-trash"></i>',
        'uploadIcon'=>'<i class="fa fa-upload"></i>',
        'browseIcon'=>'<i class="fa fa-search"></i>'
    ]

])->label(false);

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
<?php
$script = <<<JS
    $('document').ready(function(){

      $('#tutorialform').on('pjax:send', function() {
       $('#studloading1').show();
       })
      $('#tutorialform').on('pjax:complete', function() {
      $('#studloading1').hide();
            })
        })

    JS;
    $this->registerJs($script);

