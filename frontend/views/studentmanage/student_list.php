<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->params['courseTitle']="<i class='fa fa-user-graduate'></i> Students";
$this->params['breadcrumbs'][] = ['label' => 'Students'];
$this->title = 'Students';
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 table-responsive">
            <!-- Custom tabs (Charts with tabs)-->
       
          
            
            <table class="table table-bordered table-striped table-hover" id="StudentList" style="width:100%; font-family:'Time New Roman'; font-size:11.5px;">
            <thead>
            <tr><th width="1%">#</th><th>Full Name</th><th>Reg#</th><th>YOS</th><th>Department</th><th width="5%">Manage</th><th></th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($students as $std): ?>
          
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= ucwords(strtolower($std->fullName)) ?></td>
            <td><?= $std->reg_no ?></td>
            <td><?= $std->YOS ?></td>
            <td><?= $std->program->department->depart_abbrev ?></td>
            <td><?= $std->program->department->college->college_abbrev ?></td>
            
            <td>
            <a href="../studentmanage/view?id=<?= $std->reg_no ?>" class="m-0"><i class="fas fa-edit"></i></a> 
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
