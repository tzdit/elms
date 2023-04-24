<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->params['courseTitle']="<i class='fa fa-chalkboard-teacher'></i> Instructors & courses";
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
    
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th>Instructor Name</th><th>Department</th><th>Courses</th><th width="18%">Action</th></tr>
            
            </thead>
            <tbody>

            
            
            <?php foreach($instructors as $instructor): 
              if($instructor->instructorID==yii::$app->user->identity->instructor->instructorID)
              {
                continue;
              }
              ?>
            
                <tr>
                <td><?= $instructor-> full_name; ?></td>
                <td><?= $instructor-> department->depart_abbrev ;?></td>
                <td>
                <?php foreach($instructor->instructorCourses as $courses ): ?>
                  <b><?= $courses-> course_code. ','; ?></b>
                <?php endforeach; ?>
                </td>
                <td> <?= Html::a('<i class="fa fa-book"></i>',['instructor-courses', 'instructorID'=>base64_encode($instructor->instructorID)], ['class'=>'btn btn-info btn-sm m-0','data-toggle'=>'tooltip','data-title'=>'Instructor courses'])?> </td>
                <?php endforeach; ?>
           
            </tbody>
            </table>
             
       

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
    responsive:true,
    dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Instructors list'
            },
            {
                extend: 'excelHtml5',
                title: 'Instructors list'
            },
            'print',
        ]
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>
