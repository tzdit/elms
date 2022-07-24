<?php
use yii\bootstrap4\Breadcrumbs;
use common\models\Session;
use common\models\User;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->params['courseTitle']='<i class="fas fa-th"></i> Dashboard';
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon elevation-0"><i class="fa fa-user-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Users</span>
                <span class="info-box-number">
                  <?=$users?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3 ">
            <a href="<?= Url::toRoute('/instructormanage/instructor-list') ?>" class="text-dark">
            <div class="info-box mb-3 ">
            <span class="info-box-icon elevation-0"><i class="fa fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Instructors</span>
                <span class="info-box-number"><?=$instructors?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= Url::toRoute('/studentmanage/student-list') ?>" class="text-dark">
            <div class="info-box mb-3">
            <span class="info-box-icon elevation-0"><i class="fa fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Students</span>
                <span class="info-box-number"><?=$students?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

       
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= Url::toRoute('/session/index') ?>" class="text-dark">
            <div class="info-box mb-3 bg-info">
            <span class="info-box-icon elevation-0"><i class="fas fa-sign-in-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Sessions</span>
                <span class="info-box-number"><?=$opensessions?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= Url::toRoute('/admin/courses') ?>" class="text-dark">
            <div class="info-box mb-3 bg-info">
            <span class="info-box-icon elevation-0"><i class="fa fa-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Courses</span>
                <span class="info-box-number"><?=$courses?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?= Url::toRoute('/admin/programs') ?>" class="text-dark">
            <div class="info-box mb-3 bg-info">
            <span class="info-box-icon elevation-0"><i class="fa fa-graduation-cap"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Programs</span>
                <span class="info-box-number"><?=$programs?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
             </a>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-info">
            <span class="info-box-icon elevation-0"><i class="fa fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Materials</span>
                <span class="info-box-number"><?=$materials?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

         
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 bg-info">
            <span class="info-box-icon elevation-0"><i class="fa fa-pen"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Online Tests</span>
                <span class="info-box-number"><?=$tests?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-sm-6 ">
          <a href="<?= Url::toRoute('/admin/activity-logs') ?>" class="text-dark">
          <div class="info-box mb-3 bg-info">
          <div class="info-box-content">
          
                <span class="info-box-text text-bold">Top Users</span>
                <span class="text-sm"><?php $count=0;
                foreach($topusers as $topuser)
                {
                  ?>
                   <div class="row border-bottom p-2"><span class="col"><?=++$count."."?>  <?=$topuser->audit_entry_user_id?></span>   <span class="text-right text-muted font-italic col" style="font-size:10px">(<?=$topuser->frequency?> Logs)</span></div>
                  <?php
                }
                ?></span>
              </div>
              </div>
              </a>
          </div>
          <div class="col-sm-6 ">
          <a href="<?= Url::toRoute('/admin/activity-logs') ?>" class="text-dark">
          <div class="info-box mb-3">
          
          <div class="info-box-content">
          
                <span class="info-box-text text-bold">Top Activities</span>
                <span class="text-sm"><?php $count=0;
                foreach($topactivities as $topactivity)
                {
                
                  ?>
                   <div class="row border-bottom p-2"><span class="col"><?=++$count."."?>  <?=$topactivity->audit_entry_model_name?>  <?=$topactivity->audit_entry_operation?></span><span class="text-right text-muted font-italic col" style="font-size:10px">(<?=$topactivity->frequency?> Logs)</span></div>
                  <?php
                }
                ?></span>
              </div>
              </div>
              </a>
          </div>
             
         
      
        </div>
        <!-- /.row -->
       

      </div><!--/. container-fluid -->

    </div>
</div>
