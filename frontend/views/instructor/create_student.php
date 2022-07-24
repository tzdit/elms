<?php
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use frontend\models\UploadStudentForm;

/* @var $this yii\web\View */

$this->title = 'Upload Student(s)';
$this->params['breadcrumbs'][] = $this->title;
$this->params['courseTitle']="<i class='fa fa-plus-circle text-info'></i> Add Students";
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
        <div class="container-fluid">

     
    
           <div class="row"><div class="col-md-12">
               
                  <?= Html::a('<i class="fas fa-download" ></i>Download template', ['download-stdexcell-template'],['class'=>'btn btn-sm btn-info btn-rounded float-right mb-2']) ?>
</div></div>
              
             
            
              <div class="row">
                 <div class="col-md-6 border-right">
              
              <?php $stdmodel = new UploadStudentForm(); ?>

    <?php $form= ActiveForm::begin(['method'=>'post', 'action'=>'/instructor/import-students','options'=>['enctype'=>'multipart/form-data'],'id'=>'assessform','enableClientValidation' => true])?>
      <div class="row">
      <div class="col-md-12">
        <label>Upload Excel</label>
      <div class="custom-file">
      <?= $form->field($stdmodel,'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'myFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
      </div>
      </div>
        </div>
             <div class="row"> 
                 <div class="col-md-12">
                   <?= $form->field($stdmodel, 'program')->dropdownList($programs, ['prompt'=>'--Select--','class'=>'form-control form-control-sm'])->label(' Program') ?>
                  </div>
                 
                 </div>
        <br>
        
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Upload', ['class'=>'btn btn-info btn-md float-right ml-2']) ?>
        <!-- <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button> -->
        </div>
        </div>
        
    <?php ActiveForm::end()?>


          </div>
              <div class="col-md-6 border-right">
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
                  <div class="col-md-12">
                  <?= $form->field($model, 'status')->dropdownList(['1-status'=>'Complete', '2-status'=>'Partial', '3'=>'Not Registered'], ['prompt'=>'--Select--', 'class'=>'form-control form-control-sm'])->label('Registration Status') ?>
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
                
                 </div>
               
                   <div class="row">
                    <div class="col-md-12">
                        
                     <?= Html::submitButton('Save', ['class'=>'btn btn-info btn-md float-right mr-0']) ?>
                
                    </div>
               
                  
                 </div>
             
                 </div>
               
                
                
             
                <?php ActiveForm::end() ?>
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
