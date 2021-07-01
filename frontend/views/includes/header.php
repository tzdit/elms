<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
     <!-- Navbar -->
     <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
    <!--   <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->
      <!-- Fullscreen media -->
       <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
      <?php if(Yii::$app->user->can('STUDENT')): ?>
        <a class="nav-link" data-toggle="dropdown" href="#" id="username"><span class="fas fa-user"></span>
          <i ><?php echo ucwords(Yii::$app->user->identity->student->fullName) ?></i>
        </a>
      <?php endif ?>

      <?php if(Yii::$app->user->can('SYS_ADMIN') || Yii::$app->user->can('INSTRUCTOR') || Yii::$app->user->can('SUPER_ADMIN')): ?>
        <a class="nav-link" data-toggle="dropdown" href="#" id="username"><span class="fas fa-user"></span>
          <i><?php echo " ".Yii::$app->user->identity->username ?></i>
        </a>
      <?php endif ?>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="<?= Url::to(['home/changepassword'])  ?>" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> <span class="small"> Change password</span>
          </a>
          
          <div class="dropdown-divider"></div>

          <?php if(Yii::$app->user->can('STUDENT')): ?>
          <a href="<?= Url::to(['home/add_email'])  ?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> <span class="small"> Add Email</span>
          </a>
          <?php endif ?>

          <div class="dropdown-divider"></div>

           <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
            <i class="fas fa-power-off"></i><span class="small"> Logout</span>
      
          </a>
       


          <?= Html::beginForm(['/auth/logout'], 'post', ['id'=>'logout-form']) ?>
          <?= Html::endForm() ?>
         
        </div>
      </li>
     
     
    </ul>
  </nav>