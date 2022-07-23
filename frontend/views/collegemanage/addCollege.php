<?php
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\RegisterInstructorForm;
use yii\helpers\ArrayHelper;
use common\models\AuthItem;
use common\models\College;



?>

    

<div class="modal fade" id="collegemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     <div class="modal-header pl-4 p-2 bg-info"><div class="modal-title ml-1"><i class='fa fa-plus-circle'></i> Add College</div></div>
      <div class="modal-body">
        <div class="container-fluid">
       
        <!-- Main row -->
        <div class="row">
        <section class="col-md-12">
             
            
            
              <div class="row">
              <div class="col-sm-12">
              <?php $model=new College;$form = ActiveForm::begin(['method'=>'post','action'=>'/collegemanage/create']); ?>

                <?= $form->field($model, 'college_name')->textInput(['maxlength' => true,'placeholder'=>'College Name'])->label(false) ?>

                <?= $form->field($model, 'college_abbrev')->textInput(['maxlength' => true,'placeholder'=>'College Acronym (abbrev)'])->label(false) ?>

                <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-default float-right bg-info']) ?>
                </div>

                <?php ActiveForm::end(); ?>
              </div>
          
              </div>
              </div>
                 
              </div>
       
        </section>
  
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

    </div>
    </div>
</div>
</div><!-- /.container-fluid -->

</div>
</div>
<?php 
$script = <<<JS
 // Dropzone.autoDiscover = false;
$(document).ready(function(){
  //alert("Heloo JQQUERY");
  $("#file-input").fileinput({
    uploadClass:'btn btn-info',
    browseOnZoneClick: true,
    uploadIcon: '<i class="fa fa-upload"></i>'
    
  });

 
})
JS;
$this->registerJs($script);
?>
