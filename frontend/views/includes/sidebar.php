<?php 
use yii\helpers\Url;
?>
<nav class="mt-2" style="height:57%;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
           <li class="nav-item">
            <a href="<?= Url::to(['/home/dashboard']) ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
          <!--START OF SUPER ADMIN ROLE -->
          <?php if(Yii::$app->user->can('SUPER_ADMIN')):?>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=Url::toRoute('users/create')?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('users/admin-list') ?>" class="nav-link">
                  <i class="fas fa-cogs nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
             
            </ul>
          </li>
           
           
          <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-cog nav-icon"></i>
                  <p>Roles</p>
                </a>
        </li>
             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-cog nav-icon"></i>
                  <p>Permissions</p>
                </a>
              </li>
              <?php endif ?> <!---END OF SUPER ADMIN ROLE-->

              <!-- START OF SYS_ADMIN ROLE -->
            <?php if(Yii::$app->user->can('SYS_ADMIN')): ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructormanage/instructor-list') ?>" class="nav-link">
                 <i class="fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Instructors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/studentmanage/student-list') ?>" class="nav-link">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/departmentmanage/index') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Departments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/collegemanage/index') ?>" class="nav-link">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Colleges</p>
                </a>
              </li>
            </ul>
          </li>
            <?php endif ?> <!-- END OF SYS_ADMIN ROLE-->
            <!-- ======================================================= -->

              <!-- START OF INSTRUCTOR ROLE -->   
          
            <?php if(Yii::$app->user->can('INSTRUCTOR')): ?>
         
          <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/courses') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Take a new course</p>
                </a>
              </li>
            <?php  endif ?>  <!-- END OF INSTRUCTOR ROLE -->

              <!-- START OF STUDENT ROLE -->
              <?php if(Yii::$app->user->can('STUDENT')): ?>
                <li class="nav-item">
                <a href="<?= Url::toRoute('/student/courses') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>My Courses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/student/carrycourse') ?>" class="nav-link">
                  <i class="fas fa-file nav-icon"></i>
                  <p>Carry Courses</p>
                </a>
              </li>
              <?php endif ?> <!-- END OF STUDENT ROLE -->

          <!--START OF HOD ROLE -->
          <?php if(Yii::$app->user->can('INSTRUCTOR & HOD')): ?>
            <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/courses') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Take a new course</p>
                </a>
              </li>
          
            <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/student-list') ?>" class="nav-link">
                <i class="fas fa-users"></i>
                  <p>Manage Students</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/create-program') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Manage Programs</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/create-course') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Manage Courses</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/instructor-course') ?>" class="nav-link">
                <i class="fas fa-users"></i>
                  <p>Instructors </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/assign-course') ?>" class="nav-link">
                <i class="fas fa-tasks"></i>
                  <p>Assign Course </p>
                </a>
              </li>
              <?php endif ?> <!-- END OF STUDENT ROLE -->
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

      <div class="card">
    <div class="card-header">
      Have a feedback or need support?<span style="font-size:24px;margin-left:5px" class="text-success"><i class="fab fa-whatsapp"></i></span><span style="font-size:24px;margin-left:5px" class="text-success"><i class="fa fa-phone"></i></span><span style="font-size:24px; margin-left:5px" class="text-success"><i class="fas fa-sms"></i></span>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">(+255) 755189736</div>
          </div>
          <div class="row">
              <div class="col-md-12">(+255) 784085190</div>
          </div>
          <div class="row">
              <div class="col-md-12">(+255) 746185067</div>
          </div>
          </div>

          </div>
    </div>
    <!-- /.sidebar -->
  
    <div class="sidebar-custom">
      <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
      <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>
