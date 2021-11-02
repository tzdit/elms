<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Instructors $ Courses';
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
              <div class="card-header p-2">
                <h3 class="card-title com-sm-12">
                  <i class="fas fa-list mr-1 text-info"></i>
                 List of Instructors with their respective courses 
                 
                </h3>
        
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th>Instructor Name</th><th>Department</th><th>Courses</th></tr>
            
            </thead>
            <tbody>

            
            <?php 
            foreach($instructors as $instructor)
            {
                echo '<tr>';
                echo '<td>' .$instructor->full_name.'</td>';
                echo '<td>' .$instructor->department->depart_abbrev.'</td>';
                
                echo '<td>';
                foreach($instructor->instructorCourses as $courses )
                {
                  echo '<b>'. $courses->course_code. ', '.'</b>';
                  
                }
                echo '</td>';
            
                

            }
            
            ?>
            
           
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
  $("#StudentList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>
