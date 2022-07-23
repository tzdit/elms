    <?php
    use yii\helpers\Html;
    use yii\bootstrap4\ActiveForm;
    use yii\helpers\Url;
    ?>
    <div class="card card-outline card-secondary">
    <div class="card-header text-center">
    <div class="container-fluid text-center ">
    <img src="/img/dit-logo.jpeg"  style="height:65%;width:40%;margin-bottom:1%"></img>
    
    </div>
   
      <span>DIT-ELMS</span>
    </div>
    
    <div class="card-body">
    <?php $form = ActiveForm::begin() ?>
       <div class="container-fluid" >
         <div class="row">
           <div class="col-12">
            
               <?= $form->field($model, 'username')->textInput(['class'=>'form-control form-control-block', 'placeholder'=>'Username'])->label(false) ?>
           
          </div>
        
        <div class="col-12">
            
               <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control form-control-block', 'placeholder'=>'Password'])->label(false) ?>
   
           
         </div>
       <div class="row">
          <div class="col-12 mt-3 md-4">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          
        </div>
            
           <div class="col-12 mt-3">
             <?= Html::submitButton(' Login', ['class'=>'btn btn-info btn-block col p-1'])?>
           </div>

           </div>
       </div>
       
    </div>
    
    </div>
    <hr/>
    <?php ActiveForm::end() ?>
 
  </div>
    <!-- /.card-body -->
    <!--
   <span>Students' Registration <a href="/student/register">here</a><br>
   &nbsp;<img src="/img/announcement.gif" class="img-circle"  style="height:10%;width:10%;margin-bottom:1%"></img><i class="blinking text-danger">Deadline: 29/12/2021</i></span>-->
 
    
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