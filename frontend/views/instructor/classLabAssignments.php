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
use frontend\models\ClassRoomSecurity;
use frontend\models\CourseStudents;

/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fas fa-book-reader'></i> ".ClassRoomSecurity::decrypt($cid)." Lab Assignments";
$this->title = ClassRoomSecurity::decrypt($cid)." Lab Assignments";
$this->params['breadcrumbs'] = [
  ['label'=>'class Dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>$cid])],
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
        
              
       




<!-- ########################################### assignment work ######################################## -->

<?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid]); ?>      



      <div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-info btn-rounded float-right mb-2" data-target="#createLabModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create New Lab</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample">
<?php 
if($assignments==null)
{
  echo '<div style="width:91%"  class="container border p-2  d-flex justify-content-center p-5"><span class="text-center text-muted text-lg"><i class="fa fa-info-circle text-warning"></i> No Lab Assignment found</span></div>'
  ?>

<?php
  // return false;
}
else
foreach( $assignments as $assign ) : 

?>


<div class="card card-outline card-info">
  <div class="card headcard">
    <div class="card-header p-2 shadow" id="heading<?=$assign->assID?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$assign->assID?>" aria-expanded="true" aria-controls="collapse<?=$assign->assID?>">
        <i class="fas fa-clipboard-list"></i> <?php echo $assign->assName;?>
        </button>
      </div>
      <div class="col-sm-1" data-toggle="collapse" data-target="#collapse<?=$assign->assID?>" aria-expanded="true" aria-controls="collapse<?=$assign->assID?>">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$assign->assID?>" class="collapse shadow" aria-labelledby="heading<?=$assign->assID?>" data-parent="#accordionExample">
      <div class="card-body ">
        <div class="row">
        
      <div class="col-md-3 col-sm-6 col-12">
      <a href="<?=Url::to(['instructor/stdwork/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' => ClassRoomSecurity::encrypt($assign->assID)]) ?>" >
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Submitted</span>
                <span class="info-box-number"><?=round($assign->getSubmitsPercent(),2)?>%</span>
              </div>
        
            </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <a href="<?=Url::to(['instructor/missed-workmark/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' =>ClassRoomSecurity::encrypt($assign->assID)]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Missing</span>
                <span class="info-box-number"><?=round($assign->getMissingAssignmentsPerc(),2)?>%</span>
              </div>
     
            </div>
          </a>
    
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=Url::to(['instructor/stdworkmark/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' =>ClassRoomSecurity::encrypt($assign->assID)]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Marked</span>
                <span class="info-box-number"><?=round($assign->getMarkedAssignmentsPerc(),2)?>%</span>
              </div>
      
            </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=Url::to(['instructor/failed-assignments/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' =>ClassRoomSecurity::encrypt($assign->assID)]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Failed</span>
                <span class="info-box-number"><?=round($assign->getFailurePerc(),2)?>%</span>
              </div>
         
            </div>
            </a>
          </div>
</div>

          <!--################################################################################################################ -->
        
      </div>

      <div class="card-footer p-2 bg-white border-top ">
      <div class="row">
      <div class="col-md-9" style="font-size:12px;">
      <i class="fas fa-clock" aria-hidden="true"></i> <b>Deadline : </b> <?= $assign -> finishDate ?>
      </div>
      <div class="col-md-3">
        
      <a href="#" class="btn btn-sm btn-danger float-right ml-2 assdel" assid=<?=$assign->assID ?>><span><i class="fas fa-trash"></i></span></a>
      <?= Html::a('<i class="fas fa-edit"></i>',['update', 'id'=>ClassRoomSecurity::encrypt($assign->assID)], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      <a href="/storage/temp/<?= $assign -> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      <?= Html::a('<i class="fa fa-pen"></i>',['mark', 'id'=>ClassRoomSecurity::encrypt($assign->assID)], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $ass--;
        
        ?>
        
<div class="modal fade" id="modal-danger<?= $assign -> assID ?>">

        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Deleting <b> <?= $assign -> assName ?> </b> Assignment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
            
              <p>Are you sure, you want to delete <b> <?= $assign -> assName ?> </b> assignment&hellip;?</p>
              
            </div>
            <div class="modal-footer justify-content-between">
            
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <?= Html::a('Delete', ['delete', 'cid'=>$assign->course_code, 'id'=>$assign -> assID], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        
      </div>
      <!-- /.modal -->
  
  <?php endforeach ?>


</div>

</div>



       
          </div></div></div></div>

    
<!--  ###################################render model to create_assignment ###########################################-->
<?php 
$assmodel = new UploadAssignment();
?>
<?= $this->render('assignments/create_assignment', ['assmodel'=>$assmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to Create_tutorial ##############################################-->
<?php 
$tutmodel = new UploadTutorial();
?>
<?= $this->render('tutorials/create_tutorial', ['tutmodel'=>$tutmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to Create_lab ####################################################-->
<?php 
$labmodel = new UploadLab();
?>
<?= $this->render('labs/create_lab', ['labmodel'=>$labmodel, 'ccode'=>$cid]) ?>

<!-- ############################################## the student adding modal ######################################## -->
<?php 
$assignstudentsmodel = new StudentAssign();
?>
<?= $this->render('assignstudents', ['assignstudentsmodel'=>$assignstudentsmodel, 'ccode'=>$cid]) ?>
<!--  ###################################new assessment modal ####################################################-->
<?php 
$assessmodel = new External_assess();
?>
<?= $this->render('assessupload', ['assessmodel'=>$assessmodel, 'ccode'=>$cid]) ?>
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

//tutorial deleting
$(document).on('click', '#tutodelete', function(){
var ccode = $(this).attr('ccode');
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
      url:'/instructor/deletetut',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{id:ccode},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Deleted!',
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
$(document).on('click', '#assessdelete', function(){
var assessid = $(this).attr('assessid');
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
      url:'/instructor/delete-assessment',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{assessid:assessid },
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
