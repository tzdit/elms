<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;
use common\models\Groups;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Student List in a group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['student/student_groups']];

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
                 Students List
                 
                </h3>
               
                <h4  class="float-right m-0 col-xs-12">Group Name: <span class= "fas fa-primary" id="group_name">  <?= ucwords($group_name->groupName); ?> </span> </h5>
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="groups" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Full Name</th><th>Registration Number</th><th>Gender</th><th>Action</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($data as $student): ?>
              
                <tr>
                <td><?= ++$i; ?></td>
                <td><?= strtoupper( $student->fname . ' ' .  $student->mname . ' ' . $student->lname ) ?></td>
                <td><?= $student->reg_no ?></td>
                <td><?= $student->gender ?></td>
                <td>

                <a href="<?= Url::toRoute(['/student/remove_student_from_group', 'id' => $student->studentGroups[0]->SG_ID])?>" class=" btn btn-primary btn-sm m-0">
                
                <i class="fas fa-minus-square" ></i></a>

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
  $("#groups").DataTable({
    responsive:true
  });
  // alert("JS IS OKEY")
});
JS;
$this->registerJs($script);
?>












