<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['student-list']];
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
              <div class="card-header p-2">
                <h3 class="card-title com-sm-12">
                  <i class="fas fa-list mr-1 text-info"></i>
                 List of Students
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Full Name</th><th>Reg#</th><th>YOS</th><th>Department</th><th>College</th><th width="5%">Manage</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($students as $std): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= $std->fullName ?></td>
            <td><?= $std->reg_no ?></td>
            <td><?= $std->YOS ?></td>
            <td><?= $std->program->department->depart_abbrev ?></td>
            <td><?= $std->program->department->college->college_abbrev ?></td>
            <td>
            <a href="../studentmanage/view?id=<?= $std->reg_no ?>" class="btn btn-info btn-sm m-0"><i class="fas fa-edit"></i></a> 
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
  $("#StudentList").DataTable({
    responsive:true
  });
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>
