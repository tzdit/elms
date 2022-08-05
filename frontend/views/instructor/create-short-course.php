<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Program;
use yii\helpers\Url;

$this->params['courseTitle']="<i class='fa fa-book text-info'></i> Short Courses List";
?>
<div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info p-1">
        <span class="modal-title" id="exampleModalLabel"><span class="ml-2"><i class="fa fa-plus-circle"></i>  Create New Course</span></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/create-short-course', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'course_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Course Name'])->label(false)?>
        </div> 
        <div class="col-md-6">
        <?= $form->field($model, 'course_duration')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Duration (months)'])->label(false)?>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'course_code')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Course Code (ex: SH1)'])->label(false)?>
        </div>

        <div class="col-md-6">
        <?= $form->field($model,'departments')->dropdownList($departments,['class'=>'form-control form-control-sm', 'prompt'=>'--Select Department --' ,'id'=>'assignstudents2','data-placeholder'=>'Select course Department','style'=>'width:100%'])->label(false)?>
        </div> 
        </div>
        

        

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('<i class="fa fa-plus-circle text-info"></i> Submit', ['class'=>'btn btn-info btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>


<!-- table for program -->
<div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
         
            
              
              
              
              </div><!-- /.card-header -->
            
            <table class="table table-bordered table-striped table-hover" id="CourseList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <a href="/short-course-advert/index" class="btn btn-sm btn-info btn-rounded float-right ml-1 col-xs-12" ><i class="fa fa-bullhorn" ></i> Ads</a>
              <a href="#" class="btn btn-sm btn-info btn-rounded float-right m-0 col-xs-12" data-target="#createCourseModal" data-toggle="modal"><i class="fas fa-plus" ></i> Create New Course</a>
              
            <thead>
            <tr><th width="1%">#</th><th>Name</th><th>Code</th><th>Credit</th><th>Semester</th><th>Status</th><th>CAW</th><th>SEW</th><th width="10%">Toolbar</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($courses as $course): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><a href="<?=Url::toRoute(['instructor/view-coz', 'cid'=>$course->course_code])?>">
              <?= $course->course_name ?>
            </a>
            </td>
            <td><?= $course->course_code ?></td>
            <td>N/A</td>
            <td>N/A</td>
            
            <td>N/A</td>
            <td>N/A</td>
            <td>N/A</td>
  
            <td>
 
                <?= Html::a('<i class="fas fa-eye inner text-info" data-toggle="tooltip" data-title="Course Profile"></i>',['view-coz', 'cid'=>$course->course_code], ['class'=>' ml-1'])?>
                <?= Html::a('<i class="fas fa-edit text-info" data-toggle="tooltip" data-title="Update Course"></i>',['updatecoz', 'cozzid'=>$course->course_code], ['class'=>'mr-1'])?>
            <a href="#" cozid="<?=$course->course_code?>" class="text-danger  coursedel" data-toggle="tooltip" data-title="Delete Course"><span><i class="fas fa-trash"></i></span></a>
            
            </td>
            
   
            </tr>
 


<!-- <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script> -->






<!-- ################################################## -->
            <?php endforeach; ?>
            </tbody>
            </table>
             
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
 

    </div>
</div>




<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")


//Deleting Course 
$(document).on('click', '.coursedel', function(){
var courseid = $(this).attr('cozid');
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
      url:'/instructor/deletecoz',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{id:courseid },
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
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>