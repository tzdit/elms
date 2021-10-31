<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Groups');


$this->params['breadcrumbs'][] = $this->title;
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
                 Group List
                 
                </h3>
<<<<<<< HEAD
                <a href="<?= Url::toRoute('/student/add_group') ?>" class="btn btn-primary btn-sm float-right m-0 col-xs-12"><i class="fas fa-user-plus"></i> Add Group</a>
=======
                <a href="<?= Url::toRoute('/student/add_group') ?>" class="btn btn-primary btn-sm float-right m-0 col-xs-12"><i class="fas fa-user-plus"></i> Create Group</a>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="groups" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Group Name</th><th>Course Name</th><th>Created at</th><th>Action</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($data as $group): ?>
              <?php foreach($group->studentCreatedGroups as $group_detail): ?>
                <tr>
                <td><?= ++$i; ?></td>
                <td><?= $group_detail->groupName ?></td>
                <td><?= $group->course_name ?></td>
                <td><?= $group_detail->created_date ?></td>
                <td>
                <a href="<?= Url::toRoute(['/student/delete_group', 'id' => $group_detail->groupID ])?>" class="btn btn-danger btn-sm m-0">
                
                <i class="fas fa-trash" ></i></a>

                <a href="<?= Url::toRoute(['/student/student_in_login_user_course', 'id' => $group_detail->groupID ])?>" class="btn btn-primary btn-sm m-0">
                
                <i class="fas fa-plus" ></i></a>

                <a href="<?= Url::toRoute(['/student/list_student_in_group', 'id' => $group_detail->groupID ])?>" class="btn btn-primary btn-sm m-0">
                
                <i class="fas fa-eye" ></i></a>
                </td>
                </tr>
                <?php endforeach ?>
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
  $("#groups").DataTable({
    responsive:true
  });
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>












