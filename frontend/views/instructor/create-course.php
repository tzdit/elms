<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Program;



?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->


<div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h4>Create New Course</h4></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/create-course', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'course_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Course Name'])->label(false)?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'course_code')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Course Code'])->label(false)?>
        </div>

        <div class="col-md-6">
        <?= $form->field($model, 'course_credit')->textInput(['type'=>'decimal', 'min'=>0, 'max'=>20, 'class'=>'form-control form-control-sm', 'placeholder'=>'Course Credit'])->label(false)?>
        </div>

       
      </div>

      <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'course_semester')->textInput(['type'=>'number', 'min'=>1, 'max'=>2, 'class'=>'form-control form-control-sm', 'placeholder'=>'Course Semister'])->label(false)?>
        </div>

        <div class="col-md-6">
        <?= $form->field($model, 'course_duration')->textInput(['type'=>'number', 'min'=>1, 'max'=>5, 'class'=>'form-control form-control-sm', 'placeholder'=>'Course Duration'])->label(false)?>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'course_status')->dropdownList(['CORE'=>'CORE', 'ELECTIVE'=>'ELECTIVE'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select course status--'])->label(false)?>
        </div> 
        </div>
        

        

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
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
            <div class="card">
              <div class="card-header p-2">
                <h3 class="card-title com-sm-12">
                  <i class="fas fa-list mr-1 text-info"></i>
                 List of Courses
                 
                </h3>
                
                <a href="#" class="btn btn-sm btn-primary btn-rounded float-right m-0 col-xs-12" data-target="#createCourseModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Course</a>
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="CourseList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Course Name</th><th>Course Code</th><th>Course Credit</th><th>Course Semester</th><th>Course Duration</th><th>Course Status</th><th>Programs</th><th width="15%">Action</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($courses as $course): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= $course->course_name ?></td>
            <td><?= $course->course_code ?></td>
            <td><?= $course->course_credit ?></td>
            <td><?= $course->course_semester ?></td>
            <td><?= $course->course_duration ?></td>
            <td><?= $course->course_status ?></td>
            <td>
            <?php foreach($course -> programCourses as $progcoz): ?>
             <li><?= $progcoz->programCode ?></li>
            <?php endforeach; ?>
            </td>
            <td>
            <?= Html::a('<i class="fas fa-edit"></i>',['updatecoz', 'id'=>$course->course_code], ['class'=>'btn btn-info btn-sm m-0'])?> 
            <a href="#" class="btn btn-success btn-sm m-0"><i class="fas fa-eye"></i></a>
            <a href="#" class="btn btn-danger btn-sm m-0" data-toggle="modal" data-target="#modal-danger<?php $course->course_code ?>"><span><i class="fas fa-trash"></i></span></a>
            <a href="#" class="btn btn-warning btn-sm m-0" data-toggle="modal" data-target="#AssignCourseModal-<?=$course -> id;?>"><span><i class="fas fa-plus">Program</i></span></a>
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

      </div><!--/. container-fluid -->

    </div>
</div>


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

<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>