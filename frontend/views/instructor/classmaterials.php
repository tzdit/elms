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
use common\models\Module;
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
use frontend\models\ClassRoomSecurity;

/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fa fa-book'></i> ".$cid." Materials";
$this->title =$cid." Materials";
$this->params['breadcrumbs'] = [
  ['label'=>'class dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
       
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 ">
          
              <!-- <div class="card-header p-0 border-bottom-0"> -->
          
              </div>
              <!-- <div class="card card-outline card-info"> -->
              <div class="card-body" >
              
      
<!-- ########################################### material work ######################################## --> 

<?php $mat = Module::find()->where(['course_code' => $cid])->count(); ?>

<!-- ########################################### material work ######################################## -->      

      <div class="row">
        <div class="col-md-12">
          
          <?php
          if(yii::$app->session->get('currentAcademicYear')->isCurrent())
          {
          ?>
              <a href="#" class="btn btn-sm btn-info btn-rounded float-right mb-2" data-target="#createModule" data-toggle="modal"><i class="fas fa-plus-circle" data-toggle="modal" ></i>New Module</a>
              <?php
          }
          ?>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample_6">

<?php 
if($modules==null)
{
  ?>
<div class="card card-outline card-info">
<div class="row">
  <div class="col-6 mt-3">
  <p class="float-right">No module added</p>
  </div>
</div>
</div>
<?php
  // return false;
}
else
  foreach( $modules as $module ) : 

  $materials=$module->materials;

?>

<div class="card card-outline card-info">
    <div class="card-header p-2" id="heading<?=$mat?>">
      <h2 class="mb-0">
      <div class="row" >
      <div class="col-md-10 pointer" data-toggle="collapse" data-target="#collapse<?=$mat?>" aria-expanded="true" aria-controls="collapse<?=$mat?>" >
      <i class="fas fa-book-open" style="font-size:18px"></i><span style="font-size:22px"> <?=Html::encode($module->moduleName)?>:</span><span class="text-md"><?=Html::encode($module->module_description)?></span>
      </div>
      <div class="col-md-2">
      <a href="#" modid=<?=$module->moduleID?> data-toggle="tooltip" data-title="Delete Module" class="text-md text-danger float-right ml-3 moduledel"><span><i class="fas fa-trash"></i></span></a>
      <a href="<?=Url::to(['/instructor/material-upload-form', 'moduleID'=>ClassRoomSecurity::encrypt($module->moduleID)])?>" data-toggle="tooltip" data-title="Upload Material" class="text-md float-right"><span><i class="fas fa-upload "></span></i></a>
      <a href="<?=Url::to(['/instructor/share-link', 'module'=>ClassRoomSecurity::encrypt($module->moduleID)])?>" data-toggle="tooltip" data-title="Share External Link" class="text-md mr-3 float-right "><span><i class="fas fa-external-link-alt"></span></i></a>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$mat?>" class="collapse" aria-labelledby="heading<?=$mat?>" data-parent="#accordionExample_6">
      <div class="card-body" style="background-color:#def">

      <?php foreach( $materials as $material ) : ?>
        <div class="row" >
        <div class="col-md-9">
      <?php if(in_array(pathinfo($material->fileName,PATHINFO_EXTENSION),['MP4','mp4','mkv','MKV','AVI','avi']))
          {
      ?>
      <a href="<?=Url::to(['material/player','currentvid'=>$material->fileName,'currenttitle'=>$material->title])?>"><img src="/img/video thumb.png" style="width:4%;height:20px;margin-right:3px"/><?=Html::encode($material -> title) ?></a>
       <?php 
          }
          else if(in_array(pathinfo($material->fileName,PATHINFO_EXTENSION),['pdf','PDF']))
          {
       ?>
      <i class="fa fa-file-pdf-o" style="font-size:20px;color:red;margin-right:3px"></i><?=Html::encode($material -> title) ?>
      <?php
          }
          else
          {
            if($material->material_type!="link")
            {
              
      ?>     
      <a href="/storage/temp/<?=$material->fileName ?>"  class=" ml-2"><span><i class="fa fa-files-o" style="font-size:25px;margin-right:4px"></i><?=Html::encode($material -> title) ?></span></a>
      <?php
            }
            else
            {
              ?>
            <a href="<?=$material->fileName?>"  class="ml-2" target="_blank"><span><i class="fa fa-external-link-alt" style="font-size:25px;margin-right:4px"></i><?=Html::encode($material -> title) ?></span></a>
              <?php
            }
          }
      ?>
         
      
    
      </div>
      <div class="col-md-3">
     
      <a href="#" matid=<?=$material->material_ID?> class="float-right ml-2 materialdel" data-toggle="tooltip" data-title="Delete Material"><span><i class="fas fa-trash"></i></span></a>
      <a href="/storage/temp/<?=$material->fileName ?>" class=" ml-2 float-right" data-toggle="tooltip" data-title="Download Material" download><span><i class="fas fa-download"></i></span></a>
      <?php
     
     if(in_array(pathinfo($material->fileName,PATHINFO_EXTENSION),['MP4','mp4','mkv','MKV','AVI','avi']))
     {
      ?>
        <a href="<?=Url::to(['material/player','currentvid'=>$material->fileName,'currenttitle'=>$material->title])?>"  class=" ml-2 float-right" data-toggle="tooltip" data-title="View Material"><span><i class="fas fa-eye"></i></span></a>
      <?php
     }
     else
     {
      if($material->material_type!="link")
      {
     ?>
      <a href="/storage/temp/<?=$material->fileName ?>"  class=" ml-2 float-right" data-toggle="tooltip" data-title="View Material" target="_blank"><span><i class="fas fa-eye"></i></span></a>
     <?php
      }
      else
      {
        ?>
 <a href="<?=$material->fileName ?>"  class=" ml-2 float-right" data-toggle="tooltip" data-title="View Material" target="_blank"><span><i class="fas fa-eye"></i></span></a>
        <?php
      }
     }
     ?>
      </div>
      </div>
      <hr>
         <?php endforeach ?>
      </div>
       
     
     

 
  
 
  </div>
  <?php 
         $mat--;
        
        ?>
  </div>
  
  <?php endforeach ?>
  


</div>
    </div>
    </div>

</div>
    </div>
    </div>
    </div>
 



<?php
//the module creating
$modulemodel = new Module();
?>
<?= $this->render('module/_form', ['modulemodel'=>$modulemodel, 'ccode'=>$cid]) ?>

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
  
  $('#studenttable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Class students list'
            },
            {
                extend: 'excelHtml5',
                title: 'Class students list'
            },
            'print',
        ]
    } );
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
//deleting external assessment
$(document).on('click', '.moduledel', function(){
var moduleid = $(this).attr('modid');
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
      url:'/instructor/module-delete',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{moduleid:moduleid },
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

//deleting material
$(document).on('click', '.materialdel', function(){
var matid = $(this).attr('matid');
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
      url:'/instructor/delete-material',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{matid:matid},
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
//assignment deleting


//deleting material
$(document).on('click', '.assdel', function(){
var assid = $(this).attr('assid');
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
      url:'/instructor/delete',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{id:assid},
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

//Remember active tab
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

localStorage.setItem('activeTab', $(e.target).attr('href'));

});

var activeTab = localStorage.getItem('activeTab');

if(activeTab){

$('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');




}
$('#ca-form input[type=checkbox]').change(function(e){
  var assessdata=new FormData($('#ca-form')[0]);
  $.ajax({
    url: "/instructor/ca-preview", 
    data:assessdata,
    dataType:'text',
    processData: false,
    contentType:false,
    type: 'POST',
    success: function(result){
    
    $('#thepreview').html(result);
    $('#thepreview').css('font-size','12px');

       //the incomplete

       $.ajax({
    url: "/instructor/get-incomplete-perc", 
    data:assessdata,
    dataType:'text',
    processData: false,
    contentType:false,
    type: 'POST',
    success: function(result){
    
    $('#incnum').html(result);
   
   
  }});

  //the students total number

  $.ajax({
    url: "/instructor/get-student-count", 
    data:assessdata,
    dataType:'text',
    processData: false,
    contentType:false,
    type: 'POST',
    success: function(result){
    
    $('#totalstud').html(result);
   
   
  }});

  //the carries
   
  $.ajax({
    url: "/instructor/get-carries-perc", 
    data:assessdata,
    dataType:'text',
    processData: false,
    contentType:false,
    type: 'POST',
    success: function(result){
    
    $('#carry').html(result);
   
   
  }});
  }});
 
})
$('.reduce').keyup(function(e){
  e.stopPropagation();
  var assessdata=new FormData($('#ca-form')[0]);
  $.ajax({
    url: "/instructor/ca-preview", 
    data:assessdata,
    dataType:'text',
    processData: false,
    contentType:false,
    type: 'POST',
    success: function(result){
    
    $('#thepreview').html(result);
    $('#thepreview').css('font-size','12px');

     //the carries
   
  $.ajax({
    url: "/instructor/get-carries-perc", 
    data:assessdata,
    dataType:'text',
    processData: false,
    contentType:false,
    type: 'POST',
    success: function(result){
    
    $('#carry').html(result);
   
   
  }});
   
  }});
 
})
//the PDF

$('#cadownloaderpdf').click(function(e){
  e.preventDefault();
  $('#ca-form').attr('action','/instructor/get-pdf-ca');
  $('#ca-form').submit();
    
  });

  //the excel

  $('#cadownloader').click(function(e){
  e.preventDefault();
  $('#ca-form').attr('action','/instructor/generate-ca');
  $('#ca-form').submit();
  
    
  });
 




  
});
JS;
$this->registerJs($script);

?>
