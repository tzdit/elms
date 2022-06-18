<?php
use yii\bootstrap4\Breadcrumbs;
use common\models\Session;
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
            <span class="info-box-icon elevation-0"><i class="fa fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Instructors</span>
                <span class="info-box-number"><?=$instructors?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
            <span class="info-box-icon elevation-0"><i class="fa fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Students</span>
                <span class="info-box-number"><?=$students?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

       
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
            <span class="info-box-icon elevation-0"><i class="fas fa-sign-in-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Sessions</span>
                <span class="info-box-number"><?=$opensessions?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
            <span class="info-box-icon elevation-0"><i class="fa fa-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Courses</span>
                <span class="info-box-number"><?=$courses?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
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
            <div class="info-box mb-3">
            <span class="info-box-icon elevation-0"><i class="fa fa-book-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Assignments</span>
                <span class="info-box-number"><?=$assignments?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
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
          <div class="info-box-content">
          <div class="info-box mb-3">
                <span class="info-box-text">Top User (Instructor)</span>
                <span class="info-box-number"><?=$tests?></span>
              </div>
              </div>
          </div>
         
          <div class="col-sm-6">
          <div class="info-box mb-3">
          <div class="info-box-content">
                <span class="info-box-text">Top User (student)</span>
                <span class="info-box-number"><?=$tests?></span>
              </div>
              </div>
          </div>
        </div>
        <!-- /.row -->
       

      </div><!--/. container-fluid -->

    </div>
</div>
