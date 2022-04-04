<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
/* @var $this yii\web\View */

$this->title = 'Admin Dashboard';
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">Instructors</span>
                <span class="info-box-number">
               <?= $instructorsnumber?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">Students</span>
                <span class="info-box-number"><?= $studentsnumber?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">Programs</span>
                <span class="info-box-number"><?= $programsnumber?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
              <span class="info-box-text">Courses</span>
                <span class="info-box-number"><?= $coursesnumber?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-history mr-1"></i>
                  User Logs
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">

              <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'audit_entry_id',
            'audit_entry_timestamp',
            'audit_entry_model_name',
            'audit_entry_operation',
            'audit_entry_field_name',
            'audit_entry_old_value:ntext',
            'audit_entry_new_value:ntext',
            'audit_entry_user_id',
            'audit_entry_ip',
            'audit_entry_affected_record_reference',
            'audit_entry_affected_record_reference_type',
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
              
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
