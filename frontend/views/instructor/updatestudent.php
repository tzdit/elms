<?php
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use frontend\models\UploadStudentForm;

/* @var $this yii\web\View */

$this->title = 'Upload Student(s)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
        <div class="container-fluid">

       
        <!-- Main row -->
        <div class="row">
        <section class="col-md-12">
              <div class="card" style="font-family:'Times New Roman', sans-serif">
              <div class="card-header ">
                
                  <h3 class="card-title">Update Students</h3>
                
                </div>
             
              <div class="card-body">
              <div class="row">
              <div class="col-md-12">
              <p class="text-secondary mb-1">Add Single Student</p>
              <?php $form = ActiveForm::begin()?>
                 <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-4">
                   <?= $form->field($model, 'fname')->textInput(['class'=>'form-control form-control-sm'])->label('First Name') ?>
                  </div> 
                  <div class="col-md-4">
                   <?= $form->field($model, 'mname')->textInput(['class'=>'form-control form-control-sm'])->label('Middle Name') ?>
                  </div> 
                  <div class="col-md-4">
                   <?= $form->field($model, 'lname')->textInput(['class'=>'form-control form-control-sm'])->label('Last Name') ?>
                  </div>  
                 </div> 

                   <div class="row">
                   <div class="col-md-6">
                   <?= $form->field($model, 'username')->textInput(['class'=>'form-control form-control-sm'])->label('Registration Number') ?>
                  </div>
                  <div class="col-md-6">
                  <?= $form->field($model, 'YOS')->dropdownList(['1'=>'First Year', '2'=>'Second Year', '3'=>'Third Year', '4'=>'Fourth year'], ['prompt'=>'--Select--', 'class'=>'form-control form-control-sm'])->label(' Year of Study') ?>
                  </div>  
                 </div>
                 <div class="row">
                   <div class="col-md-6">
                   <?= $form->field($model, 'email')->input('email', ['class'=>'form-control form-control-sm', 'placeholder'=>'Optional'])->label('Email') ?>
                  </div>
                  <div class="col-md-6">
                   <?= $form->field($model, 'phone')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'optional'])->label('Phone Number') ?>
                  </div>  
                 </div>
                 <div class="row"> 
                 <div class="col-md-12">
                   <?= $form->field($model, 'program')->dropdownList($programs, ['prompt'=>'--Select--','class'=>'form-control form-control-sm'])->label(' Program') ?>
                  </div>
                 
                 </div>
                 
                 <div class="row">
                 <div class="col-md-6">
                
                   <?= $form->field($model, 'gender')->dropdownList(['M'=>'MALE', 'F'=>'FEMALE'], ['prompt'=>'--select--', 'class'=>'form-control form-control-sm'] )->label('Gender') ?>
                
                 </div>
                 <div class="col-md-6">
                
                   <?= $form->field($model, 'role')->dropdownList($roles, ['options'=>['INSTRUCTOR'=>['selected'=>true]], 'class'=>['form-control form-control-sm']], )->label('Role') ?>
                
                 </div>
                 </div>
               
                   <div class="row">
                    <div class="col-md-12">
                        
                     <?= Html::submitButton('Save', ['class'=>'btn btn-primary btn-md float-right mr-0']) ?>
                
                    </div>
                 </div>
                 </div>
                <?php ActiveForm::end() ?>
              </div>
              </div>
                 
              </div>
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
        </section>
         
       </div>
            <!-- /.card -->
      
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        </div>
        <!-- /.row (main row) -->
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
