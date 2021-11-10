<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<!-- ################################################# -->
<div class="modal fade" id="AssignCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h4>Assign Programs To a Course</h4></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/assign-course', 'enctype'=>'multipart/form-data']])?>

      <div class="row">
        <div class="col-md-12">
        <?= $form->field($model,'courses')->dropdownList($courses,['class'=>'form-control form-control-sm','id'=>'assignstudents2','data-placeholder'=>'Select course ','style'=>'width:100%'])->label('Course')?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model,'programs[]')->dropdownList($programs,['class'=>'form-control form-control-sm','id'=>'assignstudents3','data-placeholder'=>'Select degree Programs','multiple'=>'multiple','style'=>'width:100%'])->label('Degree Programs')?>
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
                
                <a href="#" class="btn btn-sm btn-primary btn-rounded float-right m-0 col-xs-12" data-target="#AssignCourseModal" data-toggle="modal"><i class="fas fa-plus" ></i>Asssign Course</a>
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="CourseList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Course Code</th><th>Programs</th><th width="5%">Action</th></tr>
            
            </thead>
            <tbody>

            <?php $i = 0; ?>
            <?php foreach($cozz as $course): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= $course->course_code ?></td>
            <td>
            <?php if($course -> programCourses == NULL):  ?>
              <center><i style="color:blue;"> No Program Assigned Yet!!! </i></center>
            <?php else: ?>  
            <?php foreach($course -> programCourses as $progcoz): ?>
             <b> <?= $progcoz->programCode; ?> </b>,
            <?php endforeach; ?>
            <?php endif; ?>
            </td>
            <td>
            <a href="#" class="btn btn-danger btn-sm m-0" data-toggle="modal" data-target="#modal-danger<?php $course->course_code ?>"><span><i class="fas fa-trash"></i></span></a>
            </td>
            
   
            </tr>

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



<!-- ################################################## -->
 
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