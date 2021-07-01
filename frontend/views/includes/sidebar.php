<?php 
use yii\helpers\Url;
?>
<nav class="mt-2">
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
                <a href="<?= Url::toRoute('/admin/instructor-list') ?>" class="nav-link">
                 <i class="fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Instructors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/admin/student-list') ?>" class="nav-link">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
             
            </ul>
          </li>
           <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Courses</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Programs</p>
                </a>
              </li>

            <?php endif ?> <!-- END OF SYS_ADMIN ROLE-->
            <!-- ======================================================= -->

              <!-- START OF INSTRUCTOR ROLE -->   
          
            <?php if(Yii::$app->user->can('INSTRUCTOR')): ?>
         
          <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/courses') ?>" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>My courses</p>
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
                  <p>Carried Courses</p>
                </a>
              </li>
              <?php endif ?> <!-- END OF STUDENT ROLE -->
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
      <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
      <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>
