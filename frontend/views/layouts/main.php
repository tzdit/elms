<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use common\widgets\Course;
use yii\widgets\Pjax;
//use Yii;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelementplayer.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/jump-forward/jump-forward.min.css" integrity="sha512-vHovrDslh/SZPpxgZqaPdU1/wLSaS015uMYHkCn7M2Te2o6edMJ5kk1Hmjy7LPXkMQyvpkfhgaP5X7C2cyuiPQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/skip-back/skip-back.min.css" integrity="sha512-sHVQCj7ahO15WmjKUqD0AAUNu8WWw2tpLM6MS79tysxdxXPqbAMZrrfI3tOreK6zcM4LxVH/asUEdQ1RnAhV6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/airplay/airplay.min.css" integrity="sha512-WFZbCYRtVA0KtJDNwzADb3r3ProD/T8MWwtdYTxzLtEQOTb6imgz19kP4Lfam11En/WTTHGaJtN1I8IYPC8oFg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/context-menu/context-menu.min.css" integrity="sha512-0tMNRS8a8sUxculnEHe+nBLWbSJPsiHI4YaaupqEpv7s7X6VaUxtqmqdG8WcuMvOpY1bSNSszdL8gZuJ7cGT9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/context-menu/context-menu.min.css" integrity="sha512-0tMNRS8a8sUxculnEHe+nBLWbSJPsiHI4YaaupqEpv7s7X6VaUxtqmqdG8WcuMvOpY1bSNSszdL8gZuJ7cGT9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/plugins/emojionearea/dist/emojionearea.min.css" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-fixed-layout layout-navbar-fixed">
<?php $this->beginBody() ?>

<div class="wrapper">
     <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo Yii::getAlias('@web/img/logo.png'); ?>" alt="LOGO" height="60" width="60">
  </div> -->
     <!-- Navbar -->
  <?= $this->render('/includes/header') ?>
  <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- also this you may trie these 082B45  # #0062CC
    lovely background style="background:#001832"
  -->
  <aside class="main-sidebar main-sidebar-custom sidebar-light-primary  elevation-2 pace-primary " style="background-color:rgba(238,239,247,1)" >
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/home/dashboard']) ?>" class="brand-link bg-primary">
      <img src="<?= Yii::getAlias('@web/img/logo.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">UDOM CLASSROOM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-primary" >
  
      <!-- Sidebar Menu -->
      <?= $this->render('/includes/sidebar') ?>
    <!-- /.sidebar-custom -->
  </aside>


    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header border-bottom p-2 show-sm">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-secondary font-weight-bold d-none d-md-block" style="font-family:'Times New Roman'; font-size:20px;">
           <?= Course::widget([
             'courseTitle'=>isset($this->params['courseTitle'])? $this->params['courseTitle']: ''
           ])?>
          </div><!-- /.col -->
          <div class="col-sm-6 float-right">
           <?= Breadcrumbs::widget([
              'homeLink'=>['label'=>'Dashboard', 'url'=>['/home/dashboard']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [''],
            'options'=>['class'=>'float-sm-right']
        ]) ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <!--Alert messages-->
    </div>
    <!-- /.content-header -->
    </div><!-- /.container-fluid -->
      <div class="container mt-2 show-sm">
      <div class="row">
      <div class="col-md-12">
      <?php if(Yii::$app->session->hasFlash('success')): ?>

          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('success') ?></strong>
            </div>
          </div>
      
      <?php endif ?>
       <?php if(Yii::$app->session->hasFlash('error')): ?>
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('error') ?></strong>
            </div>
          </div>
        
      <?php endif ?>
      <?php if(Yii::$app->session->hasFlash('info')): ?>
          <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('info') ?></strong>
            </div>
          </div>
        
      <?php endif ?>
      </div>
      
      </div>
      </div>

    <!-- Main content -->
    <section class="content mt-3">
      <?= $content ?>
      </section>
    
    <!-- /.content -->
    <!-- /////////////////////////////////////// -->
    
    <div class="card  card-success card-outline direct-chat direct-chat-primary" style="position:fixed;z-index:100;right:0; bottom:6%;border:none">
              <div class="card-header">
                <div class="card-tools">
                  <span class="text-sm mr-3 text-primary sender"></span>
              <span class="dropdown">
                <a data-toggle="dropdown" href="#">
               <i class="fa fa-envelope" style="color:gray"></i><sup class="bg-danger rounded-pill total">0</sup>
  
               </a>

               <div class="dropdown-menu dropdown-menu-lg">
          
           
         
         </div>
      </span>

                  
                  <button type="button" class="btn btn-tool">
                    <i class="fas fa-volume-up"></i>
                  </button>
                  <button type="button" class="btn btn-tool exp">
                    <i class="fa fa-expand"></i>
                  </button>
                  <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" id="collapse">
                    <i class="fas fa-minus"></i>
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
                 
                  <div class="jumbotron" style="background:none !important"><h3 class="text-md"><small style="color:rgb(119, 119, 119)">Choose Thread</small></h3></div>
                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <i class="fa fa-refresh btn-sm btn-primary" id="viewall" data-toggle="tooltip" data-title="Load All" style="position:absolute;right:0;bottom:50%;cursor:pointer"></i>
                  <ul class="contacts-list">
                    
                    <!-- End Contact Item -->
                  </ul>
                  <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <div class="input-group">
                    <span class="btn btn-sm btn-primary mr-1" id="clearthread"><i class="fa fa-trash"></i></span>
                    <input type="text" name="message" rows="2" placeholder="Message ..." class="form-control mytext"> </input>
                    <span class="btn btn-sm btn-primary ml-1" id="sendtext"><i class="fa fa-paper-plane"></i></span>
                  </div>
    
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>
          <!-- /.col -->
     
    <!-- //////////////////////////////////////// -->
  </div>
  <!-- /.content-wrapper -->
</div>
      </div>

  <!-- footer -->
 <?= $this->render('/includes/footer') ?>
  <!-- footer end -->
<?php $this->endBody() ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelement-and-player.min.js" integrity="sha512-hLCA6qoEOSjwOEIc6xi7p0g6/uW2SAqS7gGZIxfN4jYabdJVsW7ANuUeih/vRrU3nGpf9cnsadaC+W3qoDqIQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/jump-forward/jump-forward.min.js" integrity="sha512-C0d4gm7678yhqNgSYXd14/1EZ/CE1QgubhVs8r7iLKl+ElSjzCNVrpSYwW8C+V6q/qHUJ1ZDos4g6Kmpw5uMjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/skip-back/skip-back.min.js" integrity="sha512-MRqijnTHZOc7Nxy7cbVb81q6cMP48Z9yS0xv/cmBq0Y4q1MoL5toFSckjsW42SfD3/If27aIaq/v6tVCwmDOFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/airplay/airplay.min.js" integrity="sha512-q18A9OHcyp4bXsGsJitgyx4A9EIL7FWV11HMrm/Tb5xrStI3YLBF0o6Bc7iPT5ipfIsVpS7pbNzkAdEUkpGayA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/context-menu/context-menu.min.js" integrity="sha512-SCF51k9SJUZXsQbbiqzjE7SwsbS/Nbt8upzpl1Cboen7sVisv3BTrDjlCPBLihM8fbTBwwGSM4QJdBH3n+vmEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript" src="/plugins/popper/popper.min.js"></script>
<script type="text/javascript" src="/plugins/emojionearea/dist/emojionearea.min.js"></script>






<script>
    $('video').mediaelementplayer({
      features: ['playpause','current','progress','duration','volume','trucks','preview','airplay','jumpforward','skipback','fullscreen','contextmenu']
    });
$(document).ready(function(){
  $('#collapse').CardWidget('toggle');
 //$('#collapse').toggle();
 console.log($('#collapse'));

 /////////////
function loadOnlineMates()
{
  var data={
    "all":1
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/get-online-mates",data)
.done(function(an){
 var mates=an;
 var element="";
 for(var mate in mates)
 {
  var currentmate=mates[mate];
  element+='<li id="'+currentmate.userid+'" class="contactelem" data-widget="chat-pane-toggle"><a href="#"><img class="contacts-list-img" src="/img/chatuser.png" alt="">';
  element+='<div class="contacts-list-info"><span class="contacts-list-name text-sm">';
  element+=currentmate.username+'<small class="contacts-list-date float-right">~'+currentmate.role+'</small></span>';
  element+='<span class="contacts-list-msg text-sm">'+currentmate.prog_dept+' | '+currentmate.college+' | '+currentmate.year+'</span>';
  element+='</div></a></li>';



 }
 $('.contacts-list').html(element);
})
}

function loadAllOnline()
{
  var data={
    "all":null
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/get-online-mates",data)
.done(function(an){
 var mates=an;
 var element="";
 for(var mate in mates)
 {
  var currentmate=mates[mate];
  element+='<li id="'+currentmate.userid+'" class="contactelem" data-widget="chat-pane-toggle"><a href="#"><img class="contacts-list-img" src="/img/chatuser.png" alt="">';
  element+='<div class="contacts-list-info"><span class="contacts-list-name text-sm">';
  element+=currentmate.username+'<small class="contacts-list-date float-right">~'+currentmate.role+'</small></span>';
  element+='<span class="contacts-list-msg text-sm">'+currentmate.prog_dept+' | '+currentmate.college+' | '+currentmate.year+'</span>';
  element+='</div></a></li>';



 }
 $('.contacts-list').html(element);
})
}
  

  var load=setInterval(loadOnlineMates, 1000);
///////////////////////////

$('#viewall').click(function(e){

  e.preventDefault();

  clearInterval(load);
  setInterval(loadAllOnline, 1000);

})
var other=null;
$("body").on('click','.contactelem',function(e){
  e.preventDefault();
  other=$(this).attr('id');
  loadThread();
  var sender=($(this).find('.contacts-list-name').text()) || ($(this).find('.dropdown-item-title').text());
  $('.sender').html(sender.substr(0,17));
  $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
  var threadInterval=setInterval(loadThreadNew,1000);
})

function loadThread()
{
  if(other==null){return false;}
  var data={
    "other":other
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/load-thread",data)
.done(function(an){
  if(an==false){
    $('.direct-chat-messages').html('<div class="jumbotron" style="background:none !important"><h3 class="text-md"><small style="color:rgb(119, 119, 119)">Empty</small></h3></div>');
    return false;
  }
 var threads=an;
 var elem="";
 var sender_name="";
 for(var thread in threads)
 {
  if(thread=="hasnew"){continue};
   thread=threads[thread];
   
   if(thread.owner=="other")
   {
    elem+='<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">';
    elem+='<span class="direct-chat-name float-left text-sm">'+thread.sender_name+'</span>';
    elem+=' <span class="direct-chat-timestamp float-right text-sm">'+thread.chat_time+'</span></div>';
    elem+='<img class="direct-chat-img" src="/img/chatuser.png" alt="">';
    elem+='<div class="direct-chat-text" >'+thread.chat_text+'</div></div>';
   }
   else
   {
    elem+='<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">';
    elem+='<span class="direct-chat-name float-left">'+thread.sender_name+'</span><span class="direct-chat-timestamp float-right">'+thread.chat_time+'</span> </div>';
    elem+='<img class="direct-chat-img" src="/img/chatuser.png" alt="">';
    elem+='<div class="direct-chat-text" >'+thread.chat_text+'</div></div>';
   }
                  
 }
  //adding signaling element
  elem+='<div class="direct-chat-msg d-none typing">';
  elem+='<img class="direct-chat-img" src="/img/chatuser.png" alt=""><div class="direct-chat-text bg-white rounde-pill" ><img src="/img/typing3.gif" class="img-rounded img-responsive " style="height:25px"/></div></div>';
 $('.direct-chat-messages').html(elem);
 

 //setting the whole thread read

 var thread=other;

 var data={
    "thread":other
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/set-thread-read",data)

 $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
})
}

/////loading threads with new

function loadThreadNew()
{
  if(other==null){return false;}
  var data={
    "other":other
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/load-thread",data)
.done(function(an){
console.log(an)
  if(an==false){return false;}
 var threads=an;
 var elem="";
 if(threads["hasnew"]==false){return false;}
 for(var thread in threads)
 {
   if(thread=="hasnew"){continue;}
   thread=threads[thread];
   if(thread.owner=="other")
   {
    elem+='<div class="direct-chat-msg"><div class="direct-chat-infos clearfix">';
    elem+='<span class="direct-chat-name float-left text-sm">'+thread.sender_name+'</span>';
    elem+=' <span class="direct-chat-timestamp float-right text-sm">'+thread.chat_time+'</span></div>';
    elem+='<img class="direct-chat-img" src="/img/chatuser.png" alt="">';
    elem+='<div class="direct-chat-text" >'+thread.chat_text+'</div></div>';
   }
   else
   {
    elem+='<div class="direct-chat-msg right"><div class="direct-chat-infos clearfix">';
    elem+='<span class="direct-chat-name float-left">'+thread.sender_name+'</span><span class="direct-chat-timestamp float-right">'+thread.chat_time+'</span> </div>';
    elem+='<img class="direct-chat-img" src="/img/chatuser.png" alt="">';
    elem+='<div class="direct-chat-text">'+thread.chat_text+'</div></div>';
   }
                  
 }

 //adding signaling element
    elem+='<div class="direct-chat-msg d-none typing">';
    elem+='<img class="direct-chat-img" src="/img/chatuser.png" alt=""><div class="direct-chat-text bg-white rounde-pill" ><img src="/img/typing3.gif" class="img-rounded img-responsive " style="height:25px"/></div></div>';
 $('.direct-chat-messages').html(elem);
 $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
 //setting the whole thread read

 var thread=other;

 var data={
    "thread":other
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/set-thread-read",data)

 
})
}
function sendText(rec,text)
{
  if(other==null){return false;}
  withdrawsignal();
  var data={
    "receiver":rec,
    "text":text
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/send-text",data)
.done(function(an){
  if(an==true){
    loadThread();
   
  }
  
})

}

$(".mytext").emojioneArea({
  filtersPosition: "bottom"
    });

    //typing signaling

    $('body').on('keydown','.mytext',function(k){

      var kcode = k.keyCode || k.which;
      if(kcode==13)
      {
         return false;
      }
       

      signal();

    })
//then key looking for new ones
$('body').on('keyup','.mytext',function(k){
 
  k.preventDefault();
  var text=$('.mytext')[0].emojioneArea.getText();
  var kcode = k.keyCode || k.which;

  if(kcode==13)
  {
    sendText(other,text);
    $('.mytext')[0].emojioneArea.setText("");
  }

  

})

$('.mytext')[0].emojioneArea.on('focus',function(){
 
  signal();
});


$('.mytext')[0].emojioneArea.on('blur',function(){

  withdrawsignal();
});
function signal()
{
  var data={
    "receiver":other,
    "type":"typing...",
    "roomtype":"individual"
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/send-signal",data)
}
function withdrawsignal()
{
  var data={
    "other":other,
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/withdraw-signal",data)
}

function findsignal(){
  var data={
    "signaler":other,
    "roomtype":"individual"
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/find-signal",data).done(function(data){
   console.log(data);
   if(data==false || data==""){
     $('.typing').addClass('d-none');
     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
     return false;
    }

   $('.typing').removeClass('d-none');
   $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
  })

}
setInterval(findsignal,1000);
$('body').on('click','#sendtext',function(d){
   d.preventDefault();
    
   var text=$('.mytext')[0].emojioneArea.getText();
    sendText(other,text);
    $('.mytext')[0].emojioneArea.setText("");
})

function LoadAllThreads()
{
  var data={
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/get-thread-stats",data)
.done(function(an){
$('.total').text(an.totalnew);
var element="";
  for(th in an)
  {
  var data=an[th];
  if(th=="totalnew"){continue;}
  element+='<a href="#" id="'+th+'" class="dropdown-item contactelem"><div class="media">';
  element+='<img src="/img/chatuser.png" alt="" class="img-size-50 mr-3 img-circle">';
  element+='<div class="media-body"><span class="dropdown-item-title text-sm">'+data.sender_name;
  element+='<span class="float-right text-sm badge badge-danger">~'+data.num_msgs+'</span></span></div></div></a>'
  element+='<div class="dropdown-divider"></div>';
  }
  $('.dropdown-menu-lg').html(element);
})
}
var loadthread=setInterval(LoadAllThreads,2000);

$('body').on('click','.exp',function(){
var width=$('.content').innerWidth();
$('.card').css('height','82%');
$('.direct-chat-messages').css('height','inherit');
$('.card').width(width);
$('#collapse').addClass("d-none");

});

//////clearing the thread

$('#clearthread').click(function(){
  Swal.fire({
  title: 'Are you sure?',
  text: "Delete All messages in this thread",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete'
}).then((result) => {
  if (result.isConfirmed) {
 
    var data={
      "thread":other
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
  $.get("/instructor/clear-thread",data).done(function(an){

    loadThread();
   
  })
}
})
})

})
</script>


</body>
</html>
<?php $this->endPage() ?>
