<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->params['courseTitle']='<i class="fas fa-user-secret nav-icon"></i> Admins';
$this->title = 'Admins';
$this->params['breadcrumbs'] = [
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
           
           
                <a href="<?= Url::toRoute('/users/create') ?>" class="btn btn-default btn-sm float-right m-0 col-xs-12"><i class="fas fa-user-plus"></i> Add Admin</a>
              
              <!-- /.card-header -->
            
            <table class="table table-bordered table-striped table-hover" id="AdminTable" style="width:100%; font-size:11.5px;">
            <thead>
            <tr><th width="1%">#</th><th>Full Name</th><th>Email</th><th>Phone Number</th><th>College</th><th width="15%">Action</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($users as $user): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= $user->full_name?></td>
            <td><?= $user->email?></td>
            <td><?= $user->phone?></td>
            <td><?= $user->college->college_abbrev ?></td>
            <td>
            <a href="#" class=" m-0"><i class="fas fa-edit"></i></a> 
            <a href="#" class=" m-0"><i class="fas fa-trash" ></i></a>
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
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#AdminTable").DataTable({
    responsive:true
  });
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>
