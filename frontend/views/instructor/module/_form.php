<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Module */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal fade" id="createModule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><h6><i class='fa fa-plus-circle'></i> Create New Module</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-sm">

    <?php $form = ActiveForm::begin(['action'=>'create-module']); ?>

    <?= $form->field($modulemodel, 'moduleName')->textInput(['maxlength' => true,'placeholder'=>'Ex: chapter One, lecture One...']) ?>

    <?= $form->field($modulemodel, 'module_description')->textInput(['maxlength' => true,'placeholder'=>'Ex: introduction to cooking']) ?>

    <div class="form-group">
        <?= Html::submitButton('create', ['class' => 'btn btn-primary float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
    </div>
  </div>
</div>
</div>
