<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
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
                
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <?php foreach($chats as $chat): ?>
                  <div class="direct-chat-msg">
                  <?php if($sender == $chat->instructorID): ?>
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Samia Suluhu</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="/img/announcement.gif" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                    <?= $chat->chatText ?>
                    </div>
                    <!-- /.direct-chat-text -->
                    <?php endif; ?>
                  </div>
                  
                  
                  
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <?php if($sender !== $chat->instructorID): ?>
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Kasimu Majaliwa</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="/img/announcement.gif" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Ndio ni kweli!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  
                  <!-- /.direct-chat-msg -->
                
                <?php endif; ?>
                <?php endforeach; ?>
                </div>
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
                  Pjax::begin(['id'=>'sendmessage','timeout'=>'30000']);
                  $form = ActiveForm::begin(['method'=>'post','options' => ['data-pjax' => true ], 'action'=>['/instructor/create-chat', 'stdid'=>$username]])?>
      
                  <!-- <form action="#" method="post"> -->
                  <div class="">
                  <?= $form->field($model, 'chatText')->textInput(['class'=>'form-control ', 'placeholder'=>'Type Message ...'])->label(false)?>
                  <?= $form->field($model, 'reg_no')->hiddenInput(['value'=>$username, 'class'=>'form-control form-control-sm'])->label(false) ?>
                  
                  <span class="">
                    <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Send', ['class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
                    </span>
                   
                  </div>
                  <?php 
                 ActiveForm::end();
                 
                 Pjax::end();
                ?>
               <!-- </form> -->
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>


<?php

$script = <<<JS
    $('document').ready(function(){

      $('#sendmessage').on('pjax:send', function() {
       //$('#studloading').show();
       })
      $('#sendmessage').on('pjax:complete', function() {
      //$('#studloading').hide();
            })
        })

    JS;
    $this->registerJs($script);
?>