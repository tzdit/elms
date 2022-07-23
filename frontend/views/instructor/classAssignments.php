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
$this->params['courseTitle'] ="<i class='fas fa-book-reader'></i> ".ClassRoomSecurity::decrypt($cid)." Assignments";
$this->title = ClassRoomSecurity::decrypt($cid)." Assignments";
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
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
              
              </div>
             
              <div class="card-body" >
       




<!-- ########################################### assignment work ######################################## -->

<?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid]); ?>      

      <div class="row">
        <div class="col-md-12">
              <?php
              //creating an assignment in a finished academic year is not allowed
              $academicyear=yii::$app->session->get('currentAcademicYear');
              if($academicyear->isCurrent())
              {
              ?>
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createAssignmentModal" data-toggle="modal"><i class="fas fa-plus-circle" data-toggle="modal" ></i> Create New</a>
              <?php
              }
              ?>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample">
<?php foreach( $assignments as $assign ) : ?>

  <div class="card headcard">
    <div class="card-header p-2 shadow" id="heading<?=$assign->assID?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$assign->assID?>" aria-expanded="true" aria-controls="collapse<?=$assign->assID?>">
        <i class="fas fa-book-reader"></i> <?=Html::encode($assign->assName);?>
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
                <span class="info-box-number submited" id=<?=$assign->assID?>></span>
              </div>
        
            </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <a href="<?=Url::to(['instructor/missed-workmark/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' =>ClassRoomSecurity::encrypt($assign->assID)]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Missing</span>
                <span class="info-box-number missing" id=<?=$assign->assID?>></span>
              </div>
     
            </div>
          </a>
    
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=Url::to(['instructor/stdworkmark/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' =>ClassRoomSecurity::encrypt($assign->assID)]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text ">Marked</span>
                <span class="info-box-number marked" id=<?=$assign->assID?>></span>
              </div>
      
            </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=Url::to(['instructor/failed-assignments/', 'cid'=>ClassRoomSecurity::encrypt($assign->course_code), 'id' =>ClassRoomSecurity::encrypt($assign->assID)]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Failed</span>
                <span class="info-box-number failed" id=<?=$assign->assID?> >9 %</span>
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
     
      <a href="#" class="btn btn-sm btn-danger float-right ml-2 assdel" data-toggle="tooltip" data-title="Delete" assid=<?=$assign->assID ?>><span><i class="fas fa-trash"></i></span></a>
      <a href="/storage/temp/<?= $assign -> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2" data-toggle="tooltip" data-title="Download"><span><i class="fas fa-download"></i></span></a>
      <?php
      //update and marking an assignment in a finished academic year is not allowed
      $academicyear=yii::$app->session->get('currentAcademicYear');
      if($academicyear->isCurrent())
      {
      ?>
      <?= Html::a('<i class="fas fa-edit"></i>',['update', 'id'=>ClassRoomSecurity::encrypt($assign->assID)], ['class'=>'btn btn-sm btn-warning float-right ml-2','data-toggle'=>'tooltip','data-title'=>'Update']) ?>
      <?= Html::a('<i class="fa fa-pen"></i>',['mark', 'id'=>ClassRoomSecurity::encrypt($assign->assID)], ['class'=>'btn btn-sm btn-warning float-right ml-2','data-toggle'=>'tooltip','data-title'=>'Mark All']) ?>
      <?php
      }
      ?>
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $ass--;
        
        ?>
        
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


<?php 
$labmodel = new UploadLab();
?>
<?= $this->render('labs/create_lab', ['labmodel'=>$labmodel, 'ccode'=>$cid]) ?>
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
 
  /////////////////////////
  $(".info-box-number").each(function(i,elem)
  {
    var data={
    assignment:$(elem).attr('id')
  }
  data[yii.getCsrfParam()]=yii.getCsrfToken();
    if($(elem).hasClass("submited"))
    {
      data["stat"]="submitted";
      $.get("/instructor/get-assignment-stat",data)
      .done(function(an){
       $(elem).text(an);
      })
    }
    if($(elem).hasClass("missing"))
    {
      data["stat"]="missing";
      $.get("/instructor/get-assignment-stat",data)
      .done(function(an){
       $(elem).text(an);
      })
    }
    if($(elem).hasClass("marked"))
    {
      data["stat"]="marked";
      $.get("/instructor/get-assignment-stat",data)
      .done(function(an){
       $(elem).text(an);
      })
    }
    if($(elem).hasClass("failed"))
    {
      data["stat"]="failed";
      $.get("/instructor/get-assignment-stat",data)
      .done(function(an){
       $(elem).text(an);
      })
    }
  

  });
  /////////////////////

});


JS;
$this->registerJs($script);

?>
