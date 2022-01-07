<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>


        <!-- =========================================================== -->

        <!-- Direct Chat -->
        <h4 class="mt-4 mb-2 d-flex justify-content-center">Classroom Chat </h4>
        <div class="row d-flex justify-content-center">
          <div class="col-md-8">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="card card-primary card-outline direct-chat direct-chat-primary">
              <div class="card-header">
                <h3 class="card-title">Classroom Chat with <b>[ <?php echo $username; ?> sentBy <?php echo $sender; ?> ]</b></h3>

                <div class="card-tools">
                  <span title="3 New Messages" class="badge bg-primary">3</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                
               
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="/img/announcement.gif" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Philip Mipango
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                  </ul>
                  <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              <?php 
                  
                  $form = ActiveForm::begin([
                  'id' => 'chatForm',
                  'method'=>'post', 
                  'action'=>['/instructor/create-chat', 
                  'stdid'=>$username,
                  'enableAjaxValidation'=>false
                  
                  ]])?>
      
                  <!-- <form action="#" method="post"> -->
                  <div class="">
                  <?= $form->field($model, 'chatText')->textInput(['class'=>'form-control ', 'placeholder'=>'Type Message ...'])->label(false)?>
                  <?= $form->field($model, 'reg_no')->hiddenInput(['value'=>$username, 'class'=>'form-control form-control-sm'])->label(false) ?>
                  
                  <span class="">
                    <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Send', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
                    </span>
                   
                  </div>
                 
               <!-- </form> -->
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>


<?php

$script = <<<JS
    $('document').ready(function(){
      $('body').on('beforeSubmit', '#chatForm', function () {
        var form = $(this);
         // return false if form still have some validation errors
       
         // submit form
         $.ajax({
              url: form.attr('action'),
              type: 'post',
              dataType:"json",
              data: form.serialize(),
              success: function (data) {         
               // form.trigger("reset");     ; /--__ --/ ;
              // do something with response ; /--__--/ ;
              }
         });
         //return false;
    });
    })
    JS;
    $this->registerJs($script);
    ActiveForm::end();
?>