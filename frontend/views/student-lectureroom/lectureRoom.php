<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\models\Assignment;
use yii\helpers\ArrayHelper;
use common\models\LiveLecture;
use frontend\models\LectureRoom;
use frontend\models\ClassRoomSecurity;

$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] = "<i class='fa fa-school text-info'></i> ".$cid." Lecture Room";
$this->title ="Lecture Room";
$this->params['breadcrumbs'] = [
  ['label'=>$cid.' dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
       
       <div class="jumbotron" style="background-color:rgba(40,50,150,.05)">
       <?php
         if($serverstatus==false){
           ?>
              <div class="row text-center">
                <div class="col-md-12">
              <i class="fa fa-info-circle text-danger" style="font-size:30px"></i>  Connection could not be established
              </div>
         </div>
         
          <?php
          return true;
                  }
            ?>
         <div class="row" >
         <div class="col-md-12 text-center" >

         <i class="fa fa-school" style="font-size:50px;color:rgba(70,100,255,.6)"></i><br><span style="font-size:25px"><?=$cid." Lecture Room"?></span>

         </div>
</div>

<div class="row" style="background-color:rgba(10,30,200,.1);">
         <div class="col-sm-6" style="background-color:rgba(254,254,254,.8);">
         <span class='float-md-right'><?=Html::encode(count($lectures))?> session(s)</span>
         </div>

         <div class='col-sm-6 responsiveborder' style="background-color:rgba(254,254,254,.8);border-left:solid 2px #ccc">

         <span class='float-md-left'><?=Html::encode(count($recordings))?> Recording(s)</span>
         
         </div>


</div>
<div class="row">
<div class="col-sm-6 p-4">
  <?php
   if($room!=null)
   {
     if($room->isRunning())
     {
       ?>

       <div class="row">
         <div class="col-sm-6 p-2 shadow text-danger pt-4">
         <div class="spinner-grow spinner-grow-sm text-danger pt-2 "></div>Session going on...
         </div>
        <div class="col-sm-6 p-2 shadow rounded pr-3 pl-3">
         <span class="text-sm text-primary"> <?=$room->getParticipantCount()?> Participant(s)</span>
         <marquee class="text-sm"><?=$room->getMeetingName()?></marquee>
        </div>
       </div>
       <?php
     }
     else
     {
       ?>
          <div class="row">
         <div class="col-sm-6 p-3 shadow">
         <span class="text-md"><i class="fa fa-info-circle text-success"></i>No ongoing session</span>
         </div>
     
       </div>
       <?php
     }
   }
   else
   {
    ?>
    <div class="row">
   <div class="col-sm-6 p-3 shadow">
   <span class="text-md"><i class="fa fa-info-circle text-info"></i>No ongoing session</span>
   </div>
 
 </div>
 <?php
   }
  ?>
</div>              
<div class="col-sm-6 p-4">
  <?php
  if($room==null)
  {
  ?>
<a class="shadow btn btn-sm btn-default p-3 rounded-pill text-md" href="<?=Url::to(['student-lectureroom/join-lecture']) ?>">
                                                            <i class="fa fa-play-circle" style="color:rgba(70,100,255,.6)"></i>Join Session</a>
                                                            <?php
  }
  else
  {
?>
<a class="shadow btn btn-sm btn-default p-3 rounded-pill text-md" href="<?=Url::to(['student-lectureroom/join-lecture','session'=>ClassRoomSecurity::encrypt($room->getMeetingId())]) ?>">
                                                            <i class="fa fa-play-circle " style="color:rgba(70,100,255,.6)"></i>Join Session</a>
<?php
  }
                                                            ?>
</div> 
 </div>
      
    </div>
      <div class="row d-flex justify-content-center">
      <div class="col-sm-12 table-responsive pr-2 pl-2">
     <table class="table table-stripped table-hover" style="font-size:12px">
     <table-caption class="ml-2"><img src="<?= Yii::getAlias('@web/img/onlinelectures.png') ?>" width="25" height="25" class="mr-1">Sessions Schedule</table-caption>
       <tr class="text-primary"><th>s/n</th><th>Title</th><th>Date</th><th>Time</th><th>Duration</th><th>status</th></tr>
     <?php
     $no=1;
      foreach($lectures as $lecture)
      {
     ?>
     
       <tr><td><?=$no?></td><td><?=$lecture->title?></td><td><?=$lecture->lectureDate?></td><td><?=$lecture->lectureTime?></td><td><?=($lecture->duration==0)?"Endless":$lecture->duration." min"?></td><td>
         <?php
         if($lecture->status=="New")
         {
         ?>
         <span class="badge badge-success"><?=$lecture->status?></span>
         <?php
         }
         else
         {
           print($lecture->status);
         }
         ?>
      </td></tr>
        
        
       
    
         

          <?php
          $no++;
      }
          ?>
 </table>
</div>

</div>
<div class="row d-flex justify-content-center mt-3">
      <div class="col-sm-12 table-responsive pr-2 pl-2">
     <table class="table table-stripped table-hover" style="font-size:12px">
     <table-caption class="ml-2"><img src="<?= Yii::getAlias('@web/img/onlinelectures.png') ?>" width="25" height="25" class="mr-1" >Recorded Sessions</table-caption>
       <tr class="text-primary"><th>s/n</th><th>Session</th><th>Playback Length</th><th>Playback Type</th><th>Status</th><th>Toolbar</th></tr>
     <?php
     $no=1;
      foreach($recordings as $recording)
      {
     ?>
     
       <tr><td><?=$no?></td><td><?=$recording->getName()?></td><td><?=$recording->getPlaybackLength()." min"?></td><td><?=$recording->getPlaybackType()?> </td><td><?=($recording->isPublished()==true)?"published":"Not published"?> </td><td><a href="<?=Url::to(['student-lectureroom/play-recording','playbackurl'=>$recording->getPlaybackUrl()]) ?>""><i class="fa fa-play-circle" style="font-size:22px" data-toggle="tooltip" data-title="Play"></i></a></td></tr>
        
        
       
    
         

          <?php
          $no++;
      }
          ?>
 </table>
</div>

</div>
</div>
</div>
</div>  

   


<?php 
$script = <<<JS
$(document).ready(function(){
  
  $('.info-box').hover(function(){
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
