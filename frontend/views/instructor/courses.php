<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Super Administrator Dashboard';
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
                  <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%">
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
                  <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#EnrollModal"><i class="fas fa-key"></i></a>
                 
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
Course enrollment
</div>
<div class="modal-footer">
  <button class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
  <button class="btn btn-sm btn-primary">Enroll</button>
</div>
</div>
</div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true
  });
  
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>
