<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\models\Assignment;
use yii\helpers\ArrayHelper;
use common\models\LiveLecture;
use frontend\models\LectureRoom;


if($session==null){
  print("session not found"); return false;
}
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] ="<span class='text-primary'><i class='fa fa-chalkboard-teacher'></i> Session:</span><span class='text-sm'> ".Html::encode(substr($session->lecture->title,0,30).'...')."</span>";
$this->title =Html::encode(substr($session->lecture->title,0,20)).'...';
$this->params['breadcrumbs'] = [
  ['label'=>'Lecture Room', 'url'=>Url::to(['/lecture/lecture-room'])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
       
       <div class="jumbotron" style="background-color:rgba(40,50,150,.05)">
   
       <div class="row">
         <div class="col-md-12 d-flex justify-content-center">

         <a href="<?=Url::to(['lecture/start-session','session'=>$session->lectureroomID]) ?>">
         <div class="card" style="margin-right:2px">
          <div class="card-body">
         <i class="fa fa-play-circle " style="font-size:40px;color:rgba(70,100,255,.6)"></i><br><span style="text-sm">Start Lecturing</span>
        </div>
         </div>
         </a>
         <div class="card" style="margin-left:2px" >
         <div class="card-body">
          <i class="fa fa-upload " style="font-size:40px;color:rgba(70,100,255,.6);margin-left:3px"></i><br><span style="text-sm">Upload Slides</span>
          </div>
          </div>
          </div>
          </div>


<div class="row" style="background-color:rgba(10,30,200,.1);">
         <div class="col-md-6" style="background-color:rgba(254,254,254,.8);">
         <span class='float-right'></span>
         </div>

         <div class='col-md-6' style="background-color:rgba(254,254,254,.8);border-left:solid 2px #ccc">

        
         
         </div>


</div>
      
    </div>
    <div class='container-fluid '>
      <div class="row d-flex justify-content-center">
    
      

</div>

</div>

</div>
</div>
</div>  

   
 





<?php 
$script = <<<JS
$(document).ready(function(){
  
  $('.card').hover(function(){
      $(this).css('border-radius','6px');
      $(this).css('box-shadow','5px 10px 18px #888888');

      },
      function(){
        $(this).css('border-radius','none');
        $(this).css('box-shadow','none');
        $(this).css('color','none');
     

      });


      
});
JS;
$this->registerJs($script);

?>
