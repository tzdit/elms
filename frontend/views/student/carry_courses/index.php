<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;
/* @var $this yii\web\View */

$this->title = 'Carried Courses';
?>
<div class="site-index">

 <!-- <?= VarDumper::dump($data) ?> -->

    

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
                 Courses List
                 
                </h3>
                <a value="<?= Url::to('/student/add_carry') ?>" class="btn btn-primary btn-sm float-right m-0 col-xs-12" id = "modal_button"><i class="fas fa-user-plus"></i> Add Carry</a>

                <?php
                  Modal::begin([
                    'title' => '<h2>Add Carry</h2>',
                    'id' => 'modal',
                    'size' => 'modal-lg'
                  ]);

                  echo "<div id = 'modal_content'></div>";
                  Modal::end();
                ?>
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="CarryList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Course Code</th><th>Course Name</th><th>Course Credit</th><th>Course Status</th><th>Action</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($data as $course): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= $course->course_code ?></td>
            <td><?= $course->course_name ?></td>
            <td><?= $course->course_credit ?></td>
            <td><?= strtoupper($course->course_status) ?></td>
            <td>
            <a href="<?= Url::toRoute(['/student/delete', 'id' => $course->studentCourses[0]->SC_ID ])?>" class="btn btn-danger btn-sm m-0">
            
            <i class="fas fa-trash" ></i></a>
            </td>
            </tr>
            <?php endforeach ?>
         
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
$script = <<<JS
$(document).ready(function(){
  $("#CarryList").DataTable({
    responsive:true
  });
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>












