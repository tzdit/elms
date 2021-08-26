<?php 
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>
<div class="modal fade" id="myModal<?=str_replace(" ","",$cid)?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" style="color:blue">Add partner</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <div class="container">
        <div class="col-sm-11">
        <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/add-partner']]);?>
        <?= Html::hiddenInput('ccode',$cid);?>
        <?= $form->field($partners, 'partner')->dropDownList($instructors)->label(false)?>
        </div>
        </div>
        <div class="modal-footer">
        <?= Html::submitButton('Add', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <?php ActiveForm::end()?>
         
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
  </div>

    </div>