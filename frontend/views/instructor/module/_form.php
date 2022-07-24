<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model common\models\Module */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal fade" id="createModule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><h6><i class='fa fa-plus-circle'></i> Create New Module</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-sm">

    <?php 
     Pjax::begin(['id'=>'moduleform','timeout'=>'3000']);
    $form = ActiveForm::begin(['action'=>'create-module','options' => ['data-pjax' => true ]]); 
    ?>

    <?= $form->field($modulemodel, 'moduleName')->textInput(['maxlength' => true,'placeholder'=>'Ex: chapter One, lecture One...']) ?>

    <?= $form->field($modulemodel, 'module_description')->textInput(['maxlength' => true,'placeholder'=>'Ex: introduction to cooking']) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-plus-circle"></i> create', ['class' => 'btn btn-info float-right']) ?>
    </div>

    <?php 
    ActiveForm::end(); 
    Pjax::end();
    ?>
 <?php
   Pjax::begin(['id'=>'loader']);
   ?>


   <div class="overlay" id="loading" style="background-color:rgba(0,0,255,.3);color:#fff;display:none">
     <i class="fas fa-2x fa-sync-alt fa-spin"></i>Creating...
</div>
   <?php

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

      $('#moduleform').on('pjax:send', function() {
       $('#loading').show();
       })
      $('#moduleform').on('pjax:complete', function() {
      $('#loading').hide();
            })
        })

    JS;
    $this->registerJs($script);
