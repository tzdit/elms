<?php 
use yii\helpers\Url;
?>
<nav class="mt-2" style="height:57%;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
           <li class="nav-item">
            <a href="<?= Url::to(['/home/dashboard']) ?>" class="nav-link text-light">
              <i class="nav-icon fas fa-th "></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
       

              <!-- START OF SYS_ADMIN ROLE -->
            <?php if(Yii::$app->user->can('SYS_ADMIN') || Yii::$app->user->can('SUPER_ADMIN')): ?>
            <li class="nav-item">
            <a href="#" class="nav-link text-light">
              <i class="nav-icon fa fa-user-cog"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructormanage/instructor-list') ?>" class="nav-link text-light">
                 <i class="fas fa-chalkboard-teacher nav-icon"></i>
                  <p>Instructors & HODs</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= Url::toRoute('/studentmanage/student-list') ?>" class="nav-link text-light">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>
              
            </ul>
            <li class="nav-item">
                <a href="<?= Url::toRoute('/admin/receipts') ?>" class="nav-link text-light">
                  <i class="fas fa-receipt nav-icon"></i>
                  <p>Receipts</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="<?= Url::toRoute('/departmentmanage/index') ?>" class="nav-link text-light">
                  <i class="fa fa-building nav-icon"></i>
                  <p>Departments</p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="<?= Url::toRoute('/admin/activity-logs') ?>" class="nav-link text-light">
                        <i class="fas fa-history nav-icon"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
          </li>
            <?php endif ?> <!-- END OF SYS_ADMIN ROLE-->
               <!--START OF SUPER ADMIN ROLE -->
          <?php if(Yii::$app->user->can('SUPER_ADMIN')):?>
     
           
            <li class="nav-item">
                <a href="<?= Url::toRoute('/users/admin-list') ?>" class="nav-link text-light">
                  <i class="fas fa-user-secret nav-icon"></i>
                  <p>Admins</p>
                </a>
        </li>
    
        <li class="nav-item">
                <a href="<?= Url::toRoute('/collegemanage/index') ?>" class="nav-link text-light">
                  <i class="fa fa-university nav-icon"></i>
                  <p>Campuses</p>
                </a>
              </li>

        <li class="nav-item">
            <a href="<?= Url::toRoute('/admin/academic-year') ?>" class="nav-link text-light">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                 Academic Year
              </p>
            </a>
       
          </li>
          <li class="nav-item">
            <a href="<?= Url::toRoute('/admin/config') ?>" class="nav-link text-light">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Configurations
              </p>
            </a>
       
          </li>

          <li class="nav-item">
            <a href="<?= Url::toRoute('/admin/storage') ?>" class="nav-link text-light">
              <i class="nav-icon fa fa-hdd-o"></i>
              <p>
                Storage
              </p>
            </a>
       
          </li>

          <li class="nav-item">
            <a href="<?= Url::toRoute('/admin/system-modules') ?>" class="nav-link text-light">
              <i class="nav-icon fa fa-cubes"></i>
              <p>
                System Modules
              </p>
            </a>
       
          </li>
          
          
              <?php endif ?> <!---END OF SUPER ADMIN ROLE-->
            <!-- ======================================================= -->

              <!-- START OF INSTRUCTOR ROLE -->   
          
            <?php if(Yii::$app->user->can('INSTRUCTOR')): ?>
         
          <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/courses') ?>" class="nav-link text-light">
                  <i class="fas fa-chalkboard-teacher  nav-icon"></i>
                  <p>Self-assign Courses</p>
                </a>
              </li>
            <?php  endif ?>  <!-- END OF INSTRUCTOR ROLE -->

              <!-- START OF STUDENT ROLE -->
              <?php if(Yii::$app->user->can('STUDENT') && !Yii::$app->user->identity->student->isShort()): ?>
                <li class="nav-item">
                <a href="<?= Url::toRoute('/student/courses') ?>" class="nav-link text-light">
                  <i class="fas fa-book nav-icon"></i>
                  <p>My Curriculum</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/student/carrycourse') ?>" class="nav-link text-light">
                  <i class="fas fa-file nav-icon"></i>
                  <p>Carry Courses</p>
                </a>
              </li>
              <?php endif ?> <!-- END OF STUDENT ROLE -->

              <?php if(Yii::$app->user->can('STUDENT') && Yii::$app->user->identity->student->isShort()): ?>
              <li class="nav-item">
                <a href="<?= Url::toRoute('/student/shortcourse') ?>" class="nav-link text-light">
                  <i class="fa fa-book nav-icon"></i>
                  <p>Short Courses</p>
                </a>
              </li>
              <?php endif ?> <!-- END OF STUDENT ROLE -->

          <!--START OF HOD ROLE -->
          <?php if(Yii::$app->user->can('INSTRUCTOR & HOD')): ?>
            <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/courses') ?>" class="nav-link text-light">
                <i class="fas fa-pen-alt nav-icon"></i>
                  <p>Self-assign Courses</p>
                </a>
              </li>
          
            <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/student-list') ?>" class="nav-link text-light">
                <i class="fas fa-user-graduate"></i>
                  <p>Manage Students</p>
                </a>
                <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/student-list') ?>" class="nav-link text-light">
                 <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Regular Students</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/shortcoursestudents') ?>" class="nav-link text-light">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Short Course Students</p>
                </a>
              </li>
              
            </ul>
              </li>

              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/create-program') ?>" class="nav-link text-light">
                <i class="fa fa-graduation-cap"></i>
                  <p>Manage Programmes</p>
                </a>
              </li>


              <!-- ################################################ -->

          <li class="nav-item">
          <a href="<?= Url::toRoute('/instructor/create-course') ?>" class="nav-link text-light">
            <i class="fas fa-book-open"></i>
              <p>
                Manage Modules
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="<?= Url::toRoute('/instructor/create-short-course') ?>" class="nav-link text-light">
            <i class="fas fa-book"></i>
              <p>
                Short Courses
              </p>
            </a>
          </li>


              <!-- ################################################ -->

              <li class="nav-item">
                <a href="<?= Url::toRoute('/instructor/instructor-course') ?>" class="nav-link text-light">
                <i class="fa fa-chalkboard-teacher"></i>
                  <p>Instructors </p>
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
      <?php
         $doc="/docs/";
         if(yii::$app->user->can("STUDENT"))
         {
          $doc.="student_doc.pdf";
         }
         else if(yii::$app->user->can("INSTRUCTOR"))
         {
          $doc.="instructor_doc.pdf";
         }
         else if(yii::$app->user->can("INSTRUCTOR & HOD"))
         {
          $doc.="hod_doc.pdf";
         }
         else
         {
          $doc.="super_admin_doc.pdf";
         }
      ?>
      <a href="<?=$doc?>" target="_blank" class="btn btn-secondary hide-on-collapse pos-right"><i class="fa fa-file"></i> Manual</a>
    </div>
