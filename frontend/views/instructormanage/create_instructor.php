<?php
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Create Instructor';
$this->params['breadcrumbs'] = [
    ['label'=>'Instructor & HODs List', 'url'=>Url::to(['/instructormanage/instructor-list'])],
    ['label'=>$this->title]
];
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
                
                  <h3 class="card-title">Instructor Registration</h3>
                
                </div>
             
              <div class="card-body">
              <div class="row">
              <div class="col-md-5 border-right">
              <p class="text-secondary mb-1">Add Single Instructor</p>
              <?php $form = ActiveForm::begin()?>
                 <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-12">
                   <?= $form->field($model, 'full_name')->textInput(['class'=>'form-control form-control-sm'])->label('Full Name') ?>
                  </div>  
                 </div> 

                   <div class="row">
                   <div class="col-md-6">
                   <?= $form->field($model, 'username')->textInput(['class'=>'form-control form-control-sm'])->label('Email') ?>
                  </div>
                  <div class="col-md-6">
                   <?= $form->field($model, 'phone')->textInput(['class'=>'form-control form-control-sm'])->label('Phone Number') ?>
                  </div>  
                 </div>
                 <div class="row"> 
                 <div class="col-md-12">
                   <?= $form->field($model, 'department')->dropdownList($departments, ['prompt'=>'--Select--'], ['class'=>'form-control form-control-sm'])->label(' Department') ?>
                  </div>
                 
                 </div>
                 <div class="row">
                 <div class="col-md-6">
                
                   <?= $form->field($model, 'gender')->dropdownList(['M'=>'MALE', 'F'=>'FEMALE'], ['prompt'=>'--select--', 'class'=>'form-control form-control-sm'] )->label('Gender') ?>
                
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
              <div class="col-md-7">
              <p class="text-secondary">Upload instructors using excel sheet</p>
             <form action="">
             <input type="file" name="file" id="file-input">
             </form>
              
               </div>
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
