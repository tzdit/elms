    <?php
    use yii\helpers\Html;
    use yii\bootstrap4\ActiveForm;
    use yii\helpers\Url;
    ?>
    
    <div class="container-fluid text-center ">
    <!--<img src="/img/logo.png" class="img-circle"  style="height:70%;width:25%;margin-bottom:1%"></img>-->
    <img src="/img/marry.gif" class="rounded-pill"  style="height:70%;width:55%;margin-bottom:2%"></img>
    </div>
    <div class="card card-default shadow-lg bg-white rounded" style="font-family:'Lucida Bright'">
    <div class="card-header text-center bg-primary">
      <span><b>UDOM-CLASSROOM</b></span>
    </div>
    <div class="card-body text-center">
    <?php $form = ActiveForm::begin() ?>
       <div class="container-fluid" >
         <div class="row">
           <div class="col-md-12">
            
               <?= $form->field($model, 'username')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Username'])->label(false) ?>
           </div>
        <div class="col-md-12">
            
               <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Password'])->label(false) ?>
           </div>
    <!--
           <div class='col-md-12' id='forget_password'>
         
           <a href="<?="" //Url::to(['/auth/requestpasswordreset'])  ?>">
           <span class="small"> Forgot password</span>
          </a>
           </div>
  -->
            
           <div class="col-md-4 mr-auto ml-auto">
             <?= Html::submitButton('Login', ['class'=>'btn btn-primary btn-block'])?>
           </div>

           </div>
         </div>
        
       </div>
    <?php ActiveForm::end() ?>
 
    </div>
    <!-- /.card-body -->
    
   <span>Students' Registration <a href="/student/register">here</a><br>
   &nbsp;<img src="/img/announcement.gif" class="img-circle"  style="height:10%;width:10%;margin-bottom:1%"></img><i class="blinking text-danger">Deadline: 29/12/2021</i></span>
  </div>
  <!-- /.card -->
  <?php
$script = <<<JS
 // Dropzone.autoDiscover = false;
$(document).ready(function(){
  //alert("Heloo JQQUERY");

//function blinker() {
 //$('.blinking').fadeOut(500);
 //$('.blinking').fadeIn(500);
//}
//setInterval(blinker, 1500);

 
})
JS;
$this->registerJs($script);
?>