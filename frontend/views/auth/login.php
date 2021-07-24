    <?php
    use yii\helpers\Html;
    use yii\bootstrap4\ActiveForm;
    use yii\helpers\Url;
    ?>
    <div class="container-fluid text-center ">
    <img src="/img/logo.png" class="img-circle"  style="height:70%;width:25%;margin-bottom:1%"></img>
    </div>
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

           <div class='col-md-12' id='forget_password'>
           <a href="<?= Url::to(['/auth/requestpasswordreset'])  ?>">
           <span class="small"> Forgot password</span>
          </a>
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
      