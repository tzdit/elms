<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use yii\helpers\ArrayHelper;
use common\models\LiveLecture;
use frontend\models\LectureRoom;
use frontend\models\ClassRoomSecurity;

$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] = "<i class='fa fa-school'></i> ".$cid." Lecture Room";
$this->title =$cid." Lecture Room";
$this->params['breadcrumbs'] = [
  ['label'=>'class dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
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
              <i class="fa fa-info-circle" style="font-size:30px"></i>  Connection could not be established
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
         <span class='float-right'><?=Html::encode(count($lectures))?> session(s)</span>
         </div>

         <div class='col-sm-6' style="background-color:rgba(254,254,254,.8);border-left:solid 2px #ccc">

         <span class='float-left'><?=Html::encode(count($recordings))?> Recording(s)</span>
         
         </div>


</div>
<div class="row">
<div class="col-sm-6 p-4">
         
         <a href="#" class='float-right btn btn-sm btn-default shadow text-md p-3 rounded-pill' data-target="#lectureModal" data-toggle="modal"><i class='fa fa-plus-circle' style="color:rgba(70,100,255,.6)"></i>New Session</a>
</div>             
<div class="col-sm-6 p-4">
 
<a class="shadow float-left btn btn-sm btn-default p-3 rounded-pill text-md" data-target="#sessionModal" data-toggle="modal" href="#">
                                                          <i class="fa fa-play-circle " style="color:rgba(70,100,255,.6)"></i>Start Session</a>
                                                        
</div> 
 </div></div>
      <div class="row d-flex justify-content-center">
      <div class="col-sm-12 table-responsive pr-2 pl-2">
     <table class="table table-stripped table-hover" style="font-size:12px">
     <table-caption class="ml-2"><img src="<?= Yii::getAlias('@web/img/onlinelectures.png') ?>" width="25" height="25" class="mr-1">Sessions Schedule</table-caption>
       <tr class="text-primary"><th>s/n</th><th>Title</th><th>Date</th><th>Time</th><th>Duration</th><th>status</th><th>Toolbar</th></tr>
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
      </td>
      <td>
      <a href="<?=Url::to(['lecture/session/', 'sessionid'=>ClassRoomSecurity::encrypt($lecture->lectureID)]) ?>"><i class="fa fa-eye text-primary" data-toggle="tooltip" data-title="View Session"></i></a>
      <a href="<?=Url::to(['lecture/delete-session/', 'sessionid'=>ClassRoomSecurity::encrypt($lecture->lectureID)]) ?>"><i class="fa fa-trash text-danger" data-toggle="tooltip" data-title="Delete from Schedule"></i></a>
      </td>
    </tr>
        
        
       
    
         

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
     
       <tr><td><?=$no?></td><td><?=$recording->getName()?></td><td><?=$recording->getPlaybackLength()." min"?></td><td><?=$recording->getPlaybackType()?> </td><td><?=($recording->isPublished()==true)?"published":"Not published"?> </td><td><a href="<?=Url::to(['lecture/play-recording','playbackurl'=>$recording->getPlaybackUrl()]) ?>"><i class="fa fa-play-circle"  data-toggle="tooltip" data-title="Play"></i></a>
       <a href="<?=Url::to(['lecture/delete-recording/', 'recording'=>ClassRoomSecurity::encrypt($recording->getRecordId())]) ?>"><i class="fa fa-trash text-danger" data-toggle="tooltip" data-title="Delete Recording" ></i></a>
      </td></tr>
        
        
       
    
         

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
//the module creating
$lecturemodel = new LectureRoom();

?>
<?=$this->render('newsession_form', ['model'=>$lecturemodel])?>
<?=$this->render('sessionPolicies', ['model'=>$lecturemodel])?>


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
