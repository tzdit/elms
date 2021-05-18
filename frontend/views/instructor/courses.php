<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
/* @var $this yii\web\View */

$this->title = 'Enroll Courses';
$this->params['breadcrumbs'] = [
  ['label'=>'Courses', 'url'=>Url::to(['/instructor/courses'])],
  ['label'=>$this->title]
];

?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title com-sm-12 text-secondary">
                  <i class="fas fa-book mr-1"></i>
                Available courses
                 
                </h3>
               
              
              </div><!-- /.card-header -->
              <div class="card-body">
 
             <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                  <thead>
                  <tr>
                  <th width="1%">#</th><th width="2%">Code</th><th>Name</th><th>Credit</th><th>Status</th><th>Enroll</th>
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
                      <a href="#" class="btn btn-sm btn-danger drop" data-toggle="tooltip" data-title="Drop this course"  ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-times-circle"></i></a>
                      <?php else:?>
                  <a href="#" class="btn btn-sm btn-primary enroll" data-toggle="modal" data-target="#EnrollModal" ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-check" data-toggle="tooltip" data-title="Take this course"></i></a>
                 <?php endif ?>
                  </td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                  </table>
             </div>
            
             </div>
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
<!-- Modal -->
<div class="modal fade" role="dialog" id="EnrollModal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<span class="modal-title">Enroll Course(s)</span>
<button class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
 <?= Html::beginForm(['/instructor/enroll-course'], 'post', ['id'=>'enroll-course']) ?>
 <span class="course-description mb-4"></span>
 <?= Html::input('hidden', 'ccode', null, ['id'=>'ccode']) ?>
 <div class="row border-top mt-4 mb-2">
   <div class="col-md-12 mt-2">
     <?= Html::submitButton('Enroll', ['name'=>'enroll', 'class'=>'btn btn-primary btn-sm float-right ml-2']) ?>
      <button class="btn btn-sm btn-danger float-right" data-dismiss="modal">Close</button>
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
      $('.course-description').text($(this).attr('ccode')+'=>'+$(this).attr('cname'));
      $("#ccode").val($(this).attr('ccode'));
    })
    //sweetalert start here
    $(document).on('click', '.drop', function(){
      var ccode = $(this).attr('ccode');
 

      Swal.fire({
  title: '<small>Do you want to drop this course?</small>',
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
    }, 1500);
   

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
