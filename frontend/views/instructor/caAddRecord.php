<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\ExtAssess;
use frontend\models\CA;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\ClassRoomSecurity;

/* @var $this yii\web\View */
$this->params['courseTitle'] =$cadata['title'];
$this->title =$cadata['title'];
$cid=ClassRoomSecurity::encrypt(yii::$app->session->get('ccode'));
$this->params['breadcrumbs'] = [
  ['label'=>'class-dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>$cid])],
  ['label'=>'CA generator', 'url'=>Url::to(['/instructor/class-ca-generator', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>
 <?php 
 $assignments=$cadata['Assignments'];
 $labs=$cadata['LabAssignments'];
 $others=$cadata['otherAssessments'];
  ?>

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
   <div class="container-fluid">
    <div class="card shadow">
    <div class="card-header p-2" id="heading">
    <div class="row">
    <span class="text-info pl-3"><i class="fa fa-plus-circle"></i> Add New record</span>
   </div>
    </div>
    <div class="card-body">
    <div class="bg-info row mb-4 pl-2">Registration Number</div>
    <div class="row">
         <div class="col-md-12">
         <input type="text" class="form-group form-control"></input>
         </div>
    </div>
         <?php
         if($assignments!=null)
         {
         ?>
         <div class="bg-info row mb-4 pl-2">Assignments</div>
         <div class="row">
         <div class="col-md-12">
           <?php
           for($ass=0;$ass<count($assignments);$ass++)
           {
             ?>
              <label for="assignment" class="text-sm" style="color:grey"><?=(Assignment::findOne($assignments[$ass]))->assName?></label><input type="text" class="form-group form-control"></input>
             <?php
           }
           ?>
            </div>
            </div>
        <?php
         }
        ?>
     <!-- //////// labs /////////-->
     
     <?php
         if($labs!=null)
         {
         ?>
         <div class="bg-primary row mb-4 pl-2">Lab Assignments</div>
         <div class="row">
         <div class="col-md-12">
           <?php
           for($ass=0;$ass<count($labs);$ass++)
           {
             ?>
              <label for="assignment" class="text-sm" style="color:grey"><?=(Assignment::findOne($labs[$ass]))->assName?></label><input type="text" class="form-group form-control"></input>
             <?php
           }
           ?>
            </div>
            </div>
        <?php
         }
        ?>
     <!-- //////// other assessments /////////-->

     <?php
         if($others!=null)
         {
         ?>
         <div class="bg-primary row mb-4 pl-2">Other Assessments</div>
         <div class="row">
         <div class="col-md-12">
           <?php
           for($ass=0;$ass<count($others);$ass++)
           {
             ?>
              <label for="assignment" class="text-sm" style="color:grey"><?=(ExtAssess::findOne($others[$ass]))->title?></label><input type="text" class="form-group form-control"></input>
             <?php
           }
           ?>
            </div>
            </div>
        <?php
         }
        ?>

</div>
</div>
</div>
</div>
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
