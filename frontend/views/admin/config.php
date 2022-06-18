<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */

$this->params['courseTitle']='<i class="fa fa-cogs"></i> Configurations';
$this->title = 'Configurations';
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          
          <section class="col-lg-12">
<?php $form = ActiveForm::begin(["method"=>"post"]) ?>
<?= $form->field($configs, 'config')->textArea(['class'=>'form-control p-4','style'=>'font-family:monospace;text-align:justify','rows'=>13])->label(false) ?>
<?= Html::submitButton('<i class="fa fa-save"></i> Save Changes', ['class'=>'btn  btn-default float-right mt-1']) ?>
            
<?php ActiveForm::end() ?>
            
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
     

    </div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){


  
});
JS;
$this->registerJs($script);
?>
