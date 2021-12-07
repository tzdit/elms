<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<div class="modal fade" id="studentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><h6><i class="fa fa-plus-circle"></i> Create Student-generated type</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
      Pjax::begin(['id'=>'studgroupsform','timeout'=>'30000']);
      $form = ActiveForm::begin(['method'=>'post','options' => ['data-pjax' => true ], 'action'=>['/instructor/add-student-gentype']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($studentGroups, 'generationType')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Generation Type: ex: assignment 1 groups'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($studentGroups, 'membersNumber')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Group Members Number'])->label(false)?>
        </div> 
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Create', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php 
        ActiveForm::end();
        Pjax::end();
        ?>
        <?php
   Pjax::begin(['id'=>'studloader']);
   ?>


   <div class="overlay" id="studloading" style="background-color:rgba(0,0,255,.3);color:#fff;display:none">
     <i class="fas fa-2x fa-sync-alt fa-spin"></i>Processing...
</div>
   <?php

   Pjax::end();
?>
    </div>
    </div>
  </div>
</div>
<?php
$script = <<<JS
    $('document').ready(function(){

      $('#studgroupsform').on('pjax:send', function() {
       $('#studloading').show();
       })
      $('#studgroupsform').on('pjax:complete', function() {
      $('#studloading').hide();
            })
        })

    JS;
    $this->registerJs($script);


