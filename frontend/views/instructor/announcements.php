<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\StudentCourse;
use common\models\Submit;
use common\models\Material;
use common\models\ExtAssess;
use common\models\ProgramCourse;
use common\models\Announcement;
use frontend\models\UploadAssignment;
use frontend\models\CA;
use frontend\models\UploadTutorial;
use frontend\models\PostAnnouncement;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\StudentGroups;
use frontend\models\External_assess;
use frontend\models\StudentAssign;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Class Announcements';
$this->params['breadcrumbs'] = [
  ['label'=>'Class dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>$cid])],
  ['label'=>$this->title]
];

$secretKey=Yii::$app->params['app.dataEncryptionKey'];
$cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

$this->params['courseTitle'] =$cid." Announcements";
?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 ">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
               
              
              </div>
             
              <div class="card-body" >
             
   

<!-- ########################################### Announcements ######################################## --> 
                 
                  <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#announce" data-toggle="modal" style="margin-left:5px"><i class="fas fa-plus"  ></i>New annoucement</a>
            </div>    
          </div>
   
   <div class="container-fluid">
   <?php
  
   $announcements=Announcement::find()->where(['course_code'=>$cid])->orderBy([
    'annID' => SORT_DESC ])->all();
   foreach($announcements as $announcement)
   {
     ?>
    
    <div class="card shadow" >
    <div class="card-header p-1 bg-primary" id="heading">
    <div class="row ">
    <div class="col-md-10">
    <i class="fa fa-bullhorn"></i><span style="font-size:12px;margin-left:20px"><?=Html::encode($announcement->title);?></span>
   </div>
   <div class="col-md-2 text-white" >
  <a href="#" id="announcedelete" annid=<?=Html::encode($announcement->annID)?>><i class="fa fa-trash float-right" style="color:white"></i></a>
   </div>
   </div>
    </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?=Html::encode($announcement->content) ?>
   </div>
   </div>
  
  </div>
   <div class="card-footer text-center" style="font-size:12px">
   <div class="row">
     <div class="col-md-4">
  <span class="float-left"><i class="fas fa-clock" ></i><?=Html::encode($announcement->ann_date)." ".Html::encode($announcement->ann_time)?></span>
   </div>
   <div class="col-md-8">
   <?=Html::encode($announcement->instructor->full_name)?>
   </div>
   </div>
   </div>



     </div>
    
 

   <?php 
   }
   ?>
      </div>
                  </div>
</div>
</section>
</div>
</div>
</div>


<!--  ###################################new announce modal ####################################################-->
<?php 
$announcemodel = new PostAnnouncement();
?>
<?= $this->render('announcementForm', ['announcemodel'=>$announcemodel]) ?>



<?php 
$script = <<<JS
$(document).ready(function(){
  $(".headcard").on('show.bs.collapse','.collapse', function(e) {
  $(e.target).parent().addClass('shadow');
  });
  $(".headcard").on('hidden.bs.collapse','.collapse', function(e) {
  $(e.target).parent().removeClass('shadow');
  });
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  //$("#studenttable").DataTable({
    //responsive:true,
  //});

  $(document).on('click', '.enroll', function(){
      $('.course-description').text($(this).attr('ccode')+'=>'+$(this).attr('cname'));
      $("#ccode").val($(this).attr('ccode'));
    })
    //sweetalert start here
    $(document).on('click', '.drop', function(){
      var ccode = $(this).attr('ccode');
 

      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Drop it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/dropcourse',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{ccode:ccode},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Droped!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    }, 100);
   

        }
      }
    })
   
  }
})

})


//deleting announcements
$(document).on('click', '#announcedelete', function(){
var annid = $(this).attr('annid');
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Delete it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/delete-announcement',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{annid:annid},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Deleted!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    },100);
   

        }
      }
    })
   
  }
})

})






  
});
JS;
$this->registerJs($script);

?>
