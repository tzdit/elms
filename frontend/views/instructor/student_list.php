<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Students List';
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
                 List of Students
                 
                </h3>
                <a href="<?= Url::toRoute('/instructor/create-student') ?>" class="btn btn-primary btn-sm float-right m-0 col-xs-12"><i class="fas fa-user-plus"></i> Create User</a>
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th>Full Name</th><th>Reg#</th><th>YOS</th><th>Department</th><th width="15%">Action</th></tr>
            
            </thead>
            <tbody>
            
            <?php 
            for($a=0;$a<count($students); $a++)
            {
              $current_students=$students[$a];

              for($b=0;$b<count($current_students); $b++)
              {
                echo '<tr>';
                echo '<td>' .$current_students[$b]->fullName.'</td>';
                echo '<td>' .$current_students[$b]->reg_no.'</td>';
                echo '<td>' .$current_students[$b]->YOS. '</td>';
                echo '<td>' .$current_students[$b]->program->department->depart_abbrev.'</td>';
                
                echo   '<td> 
            <a href="#" class="btn btn-info btn-sm m-0"><i class="fas fa-edit"></i></a> 
            <a href="#" class="btn btn-success btn-sm m-0"><i class="fas fa-eye"></i></a>
            <a href="#" class="btn btn-danger btn-sm m-0"><i class="fas fa-trash" ></i></a>
            </td>';
            
                '</tr>';
                 
              }
              
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
