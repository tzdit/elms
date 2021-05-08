    <?php
    use yii\helpers\Html;
    use yii\bootstrap4\ActiveForm;
    ?>
    <div class="card card-default shadow-lg bg-white rounded" style="font-family:'Lucida Bright'">
    <div class="card-header text-center bg-primary">
      <span><b>CIVE-eCLASSROOM</b></span>
    </div>
    <div class="card-body">
    <?php $form = ActiveForm::begin() ?>
       <div class="container-fluid" >
         <div class="row">
           <div class="col-md-12">
            
               <?= $form->field($model, 'username')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Username'])->label(false) ?>
           </div>
        <div class="col-md-12">
            
               <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Password'])->label(false) ?>
           </div>
            
           <div class="col-md-4 mr-auto ml-auto">
             <?= Html::submitButton('Login', ['class'=>'btn btn-primary btn-block'])?>
           </div>
           </div>
         </div>
       </div>
    <?php ActiveForm::end() ?>
 
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
      