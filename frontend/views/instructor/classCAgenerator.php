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

/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fas fa-cogs'></i> ".$cid." CA Generator";
$this->title =$cid." CA Generator";
$this->params['breadcrumbs'] = [
  ['label'=>'class-dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
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
     
       





        <!--##################### the CA ######################## -->
   <?php 
      $cas=$allcas;
      $yearID=(yii::$app->session->get('currentAcademicYear'))->yearID;
      $assignments=Assignment::find()->where(['course_code'=>$cid,'assNature'=>'assignment','yearID'=>$yearID])->all();
      $assArray=ArrayHelper::map($assignments,'assID','assName');
      $labs=Assignment::find()->where(['course_code'=>$cid,'assNature'=>'lab','yearID'=>$yearID])->all();
      $labarray=ArrayHelper::map($labs,'assID','assName');
      $others=ExtAssess::find()->where(['course_code'=>$cid,'yearID'=>$yearID])->all();
      $othersarray=ArrayHelper::map($others,'assessID','title');
   ?>
   <div class="container-fluid">
   <?php
       if(!(yii::$app->session->get('currentAcademicYear')->isCurrent()))
       {
      ?>
      <div class="alert-success text-lg p-4 alert alert-dismissible"><i class="fa fa-info-circle"></i> CA generator is not available in this academic year
      <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
       </div>
      <?php
       }
       else
       {
      ?>
    <div class="card shadow">

     
    <div class="card-header p-2" id="heading">
    <div class="row">
    <div class="col-md-2" >
 
    <span class="dropdown ml-3">
                <a data-toggle="dropdown" href="#" data-toggle="tooltip" data-title="Open Saved CAs">
               <i class="fa fa-folder"></i> Saved CAs
  
               </a>

               <div class="dropdown-menu dropdown-menu-lg text-sm">
                 <?php

                  if($cas==null){print "<span class='text-sm text-info m-4'>No saved CAs found</span>";}
                  foreach($cas as $ind=>$ca)
                  {
                 ?>
                  <li class="dropdown-item">
                    <?=$ca?>
                    <span class="float-right">
                    <a href="<?=Url::to(['/instructor/class-ca-generator','cid'=>ClassRoomSecurity::encrypt($cid),'ca'=>ClassRoomSecurity::encrypt($ind)])?>"><i class="fa fa-folder-open text-primary mr-2" data-toggle="tooltip" data-title="Open CA"></i></a>
                    <a href="<?=Url::to(['/instructor/ca-add-new','ca'=>ClassRoomSecurity::encrypt($ind)])?>"><i class="fa fa-plus-circle text-primary mr-2" data-toggle="tooltip" data-title="Add New Record"></i></a>
                    <a href="<?=Url::to(['/instructor/publish-ca','ca'=>ClassRoomSecurity::encrypt($ind)])?>"><i class="fa fa-newspaper text-primary mr-2" data-toggle="tooltip" data-title="Publish CA"></i></a>
                    <a href="<?=Url::to(['/instructor/delete-ca','ca'=>ClassRoomSecurity::encrypt($ind)])?>"><i class="fa fa-trash text-danger mr-2" data-toggle="tooltip" data-title="Delete CA"></i></a>
                    <a href="#"><i class=""></i></a>
                    </span>
                  </li>
                  <div class="dropdown-divider"></div>
                 <?php
                  }
                 ?>
              </div>
      </span>
   
    
   </div>
  
   <div class="col-md-2 text-sm" >
   <a href="<?=Url::to(['/instructor/class-ca-generator','cid'=>ClassRoomSecurity::encrypt($cid)])?>" data-toggle="tooltip" data-title="Genarate New CA"><i class="fa fa-cog"></i> New CA</a>
   </div>
   <div class="col-md-3 text-sm font-weight-bold" >
     <?=$camodel->caTitle?>
   </div>
   <div class="col-md-5 text-sm float-right">
   <div class="row">
  <div class="col-md-4 shadow float-right">
     <span>Carries:</span><span id="carry" class="text-danger font-weight-bold"></span>
  </div>
  
   <div class="col-md-4 shadow float-right">
   <span>Incompletes:</span><span id="incnum" class="text-primary font-weight-bold"></span>
</div>
   <div class="col-md-4 shadow float-right">

   <span>Total students:</span><span id="totalstud" class="text-success font-weight-bold"></span>
     
    </div>

  </div> 
   </div>
   </div>
    </div>
    <?php     
$caform = ActiveForm::begin([
    'id' => 'ca-form',
    'action'=>'/instructor/generate-ca',
    'method'=>'post',
    'options' => ['class' => 'form-horizontal']
]) ?>
    <div class="card-body">

  <div class="row">
    <div class="col-md-4">
      <!-- 
        ######################### the assignments
      -->

    <div class="card shadow" style="min-height:200px;max-height:400px" >
      <div class="card-header pt-1 pb-1 bg-primary text-sm">
        Assignments
      </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?php if(empty($assArray)){print "<span class='info text-sm'>No Assignments found</span>";} ?>
    <?= $caform->field($camodel, 'Assignments')->checkboxList($assArray)->label(false) ?>
    <?= $caform->field($camodel, 'assreduce')->textInput(['type'=>'text','class'=>'form-control form-control-sm reduce','placeholder'=>'Reduce to','id'=>'ass'])->label(false)?>
   </div>
   </div>
 
  
  </div>




     </div>

      <!--########################################-->
   </div>
   <div class="col-md-4">
      <!-- 
        ######################### the labs
      -->

    <div class="card shadow" style="min-height:200px;max-height:400px" >
    <div class="card-header pt-1 pb-1 bg-primary text-sm">
        Lab assignments
      </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?php if(empty($labarray)){print "<span class='info text-sm'>No Labs found</span>";} ?>
    <?= $caform->field($camodel, 'LabAssignments')->checkboxList($labarray)->label(false) ?>
    <?= $caform->field($camodel, 'labreduce')->textInput(['type'=>'text','class'=>'form-control form-control-sm reduce','placeholder'=>'Reduce to','id'=>'lab'])->label(false)?>
   </div>
   </div>
  
  </div>




     </div>

      <!--########################################-->
   </div>
   <div class="col-md-4">
      <!-- 
        ######################### other assessments
      -->

    <div class="card shadow" style="min-height:200px;max-height:400px">
    <div class="card-header pt-1 pb-1 bg-primary text-sm">
       Other Assessments
      </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12" id="assessments">
    <?php if(empty($othersarray)){print "<span class='info text-sm'>No assessments found</span>";} ?>
    <?= $caform->field($camodel, 'otherAssessments')->checkboxList($othersarray)->label(false)?>
    <?= $caform->field($camodel, 'otherassessreduce')->textInput(['type'=>'text','class'=>'form-control form-control-sm reduce','placeholder'=>'Reduce to','id'=>'other'])->label(false)?>
    <?= $caform->field($camodel, 'version')->hiddenInput(['value'=>$camodel->version])->label(false)?>
   </div>
   </div>

  </div>




     </div>

      <!--########################################-->
    
  </div>

   </div>


   <?php ActiveForm::end() ?>
   <div class="row">
     <div class="col-md-2"><span class="text-primary"><i class="fa fa-hand-o-down " style="font-size:18px"></i>Preview</span></div>
     <div class="col-md-10">
     <?= Html::submitButton('<i class="fa fa-download" style="font-size:18px"></i>Excel', ['class'=>'btn btn-primary btn-rounded btn-sm shadow float-right','style'=>'margin-left:2px','id'=>'cadownloader']) ?>
     <?=Html::Button('<i class="fa fa-download" style="font-size:18px"></i>PDF', ['class'=>'btn btn-primary btn-rounded btn-sm shadow float-right','id'=>'cadownloaderpdf'])  ?>
     <?=Html::Button('<i class="fa fa-save" style="font-size:18px"></i> Save & Publish', ['class'=>'btn btn-primary btn-rounded btn-sm shadow float-right mr-1','id'=>'casaverpublisher'])  ?>
     <?=Html::Button('<i class="fa fa-save" style="font-size:18px"></i> Save', ['class'=>'btn btn-primary btn-rounded btn-sm shadow float-right mr-1','id'=>'casaver'])  ?>
        </div>
   </div>
   </div>
 
   
  
  <div class="card-footer">
  
  <div class="row">
      <div class="col-md-12" id="thepreview" >
       
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

<!--  ###################################render model to create_material ####################################################-->

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
  
  $('#studenttable').DataTable({
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


  $('#casaver').click(function(e){
  e.preventDefault();
  $('#ca-form').attr('action','/instructor/ca-save');
  $('#ca-form').submit();
  
    
  });
  $('#casaverpublisher').click(function(e){
  e.preventDefault();
  $('#ca-form').attr('action','/instructor/ca-save-published');
  $('#ca-form').submit();
  
    
  });




  
});
JS;
$this->registerJs($script);

?>
