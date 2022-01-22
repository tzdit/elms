<?php 
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>
<div class="modal fade" id="myModal<?=str_replace(" ","",$cid)?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header pt-1 pb-1 ">
        <h6 class="modal-title" style="color:blue"><i class="fa fa-user-plus"></i> Add partner</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
        <div class="container">
          <div class="row">
        <div class="col-md-12">
        <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/add-partner']]);?>
        <?= Html::hiddenInput('ccode',$cid);?>
        <?= $form->field($partners, 'partner')->dropDownList($instructors)->label(false)?>
        </div>
        </div>
        </div>
        <div class="modal-footer pt-1 pb-1">
        <?= Html::submitButton('Add', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
        <?php ActiveForm::end()?>
         
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
  </div>

    </div>