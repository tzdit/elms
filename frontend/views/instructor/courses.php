<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
/* @var $this yii\web\View */

$this->title = 'Courses';
$this->params['courseTitle'] ='<i class="fas fa-chalkboard-teacher"></i> Courses';
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];

?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row text-sm">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
           
 
             <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-hover table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                  <thead>
                  <tr>
                  <th width="1%">#</th><th width="2%">Code</th><th>Name</th><th>Credit</th><th>Status</th><th><i class="fa fa-plus-circle"></i> Assign</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=0; ?>
                  <?php foreach($courses as $course): ?>
                  <tr>
                  <td><?= ++$i; ?></td>
                  <td><?= $course->course_code;  ?></td>
                  <td><?= $course->course_name;  ?></td>
                  <td><?= $course->course_credit;  ?></td>
                  <td><?= $course->course_status;  ?></td>
                  <td>
                    <?php if(Custom::isEnrolled($course->course_code)): ?>
                      <a href="#" class="btn btn-sm btn-danger drop" style="cursor:no-drop" data-title="course already taken"  ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-ban "></i></a>
                      <?php else:?>
                  <a href="#" class="btn btn-sm btn-info enroll" data-toggle="modal" data-target="#EnrollModal" ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-check" data-toggle="tooltip" data-title="Take this course"></i></a>
                 <?php endif ?>
                  </td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                  </table>
             </div>
            
             </div>
            
        

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>

      </div><!--/. container-fluid -->

    </div>
</div>
<!-- Modal -->
<div class="modal fade" role="dialog" id="EnrollModal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header text-primary">
<span class="modal-title"><i class="fa fa-question-circle"></i> Assign Course</span>
<button class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
 <?= Html::beginForm(['/instructor/enroll-course'], 'post', ['id'=>'enroll-course']) ?>
 <span class="course-description mb-4 "></span>
 <?= Html::input('hidden', 'ccode', null, ['id'=>'ccode']) ?>
 <div class="row border-top mt-4 mb-2">
   <div class="col-md-12 mt-2">
     <?= Html::submitButton('<i class="fas fa-check"></i> Confirm', ['name'=>'enroll', 'class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
      <button class="btn btn-sm btn-default float-right" data-dismiss="modal"><i class="fa fa-times"></i> Decline</button>
   </div>
 </div>

 <?= Html::endForm() ?>
</div>
</div>
</div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  
  $(document).on('click', '.enroll', function(){
      $('.course-description').text($(this).attr('ccode')+' : '+$(this).attr('cname'));
      $("#ccode").val($(this).attr('ccode'));
    })
    
 

      
  
});
JS;
$this->registerJs($script);
?>
