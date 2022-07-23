<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
/* @var $this yii\web\View */

$this->title = 'Courses';
$this->params['courseTitle'] ='<i class="fas fa-list"></i> Courses';
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];

?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
    
      
           
 
             <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-hover table-striped" id="CoursesTable" style="width:100%;font-size:12px">
                  <thead>
                  <tr>
                  <th width="1%">#</th><th width="2%">Code</th><th>Name</th><th>Credit</th><th>Status</th><th>Semester</th><th>College</th><th>Department</th>
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
                  <td><?= $course->course_semester;  ?></td>
                  <td><?= $course->department->college->college_abbrev;  ?></td>
                  <td><?= $course->department->depart_abbrev;  ?></td>
                  </tr>
                  <?php endforeach ?>
                  </tbody>
                  </table>
             </div>
            
             </div>
            
        

      
        

      </div><!--/. container-fluid -->

    </div>
</div>

<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
    dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Courses list'
            },
            {
                extend: 'excelHtml5',
                title: 'Courses list'
            },
            'print',
        ]
  });
  
  $(document).on('click', '.enroll', function(){
      $('.course-description').text($(this).attr('ccode')+' : '+$(this).attr('cname'));
      $("#ccode").val($(this).attr('ccode'));
    })
    
 

      
  
});
JS;
$this->registerJs($script);
?>
