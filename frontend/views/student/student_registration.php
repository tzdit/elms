<?php
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use frontend\models\UploadStudentForm;

/* @var $this yii\web\View */

$this->title = 'Student Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
            <div class="container text-center d-none d-lg-block d-md-block d-xl-block d-xxl-block">
    <img src="/img/dit-logo.png" class=""  style="height:60%;width:15%;margin-bottom:1%"></img>
    </div>
        <div class="container-fluid">

       
        <!-- Main row -->
        <div class="row">

        <section class="col-md-12 login-box" style="width:120%">
        <div class="container-fluid text-center ">
   
    </div>
              <div class="card" style="font-family:'Times New Roman', sans-serif;width:100%">
              <div class="card-header bg-info text-center p-1">
                <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                 <h5 class="text-md"><span><i class="fa fa-user-plus"></i></span><span> Student Registration</span></h5>
                </div>
                </div>
                </div>
              <div class="card-body">
              <div class="row">
              <div class="col-md-12">
              <?php $form = ActiveForm::begin()?>
             
                  <div class="row">
                  <div class="col-md-4">
                   <?= $form->field($model, 'fname')->textInput(['class'=>'form-control form-control-sm','placeholder'=>'First Name'])->label(false) ?>
                  </div> 
                  <div class="col-md-4">
                   <?= $form->field($model, 'mname')->textInput(['class'=>'form-control form-control-sm','placeholder'=>'Middle Name'])->label(false) ?>
                  </div> 
                  <div class="col-md-4">
                   <?= $form->field($model, 'lname')->textInput(['class'=>'form-control form-control-sm','placeholder'=>'Last Name'])->label(false) ?>
                  </div>  
                 </div> 
                 <div class="row">
                   <div class="col-md-6">
                   <?= $form->field($model, 'email')->input('email', ['class'=>'form-control form-control-sm','placeholder'=>'email address'])->label(false) ?>
                  </div>
                  <div class="col-md-6">
                   <?= $form->field($model, 'phone')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Phone number'])->label(false) ?>
                  </div>  
                 </div>
                 <div class="row"> 
                  <div class="col-md-12">
                
                  <?= $form->field($model, 'gender')->dropdownList(['M'=>'MALE', 'F'=>'FEMALE'], ['prompt'=>'--Gender--', 'class'=>'form-control form-control-sm'] )->label(false) ?>
             
                 </div>
                 </div>
                   <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12">
                    
                     <?= Html::submitButton('<i class="fa fa-user-plus" aria-hidden="true"></i>  Register', ['class'=>'btn btn-info btn-md  float-right mr-0','style'=>'width:30%']) ?>
                
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
  
$('#regno').blur(function(){
var regexp1=/^(T[0-9]{2})[-]([0-9]{2})[-](([0-9]{4})|([0-9]{5}))$/;
var regexp2=/^((T)[/](UDOM))[/]([0-9]{4})[/]([0-9]{5})$/;
var regexp=/^((HD)[/](UDOM))[/]([0-9]{4})[/](T\.([0-9]{4}))$/;
var regno=$(this).val();
if(!regexp.test(regno) && !regexp2.test(regno) && !regexp1.test(regno))
{
  $(this).val("");

  Swal.fire({
  title: 'Invalid registration number',
  text: "follow this format: T/UDOM/2000/00001 or T21-03-00001 or HD/UDOM/0001/T.2010 (for masters)...",
  icon: 'error',
  confirmButtonColor: '#3085d6',
  confirmButtonText: 'Ok'
})
  
}


}) 
 
})
JS;
$this->registerJs($script);
?>
