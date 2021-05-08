<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
//use Yii;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-fixed-layout layout-navbar-fixed">
<?php $this->beginBody() ?>

<div class="wrapper">
     <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo Yii::getAlias('@web/img/logo.png'); ?>" alt="Logo" height="60" width="60">
  </div>
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
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php echo Yii::$app->user->identity->username; ?>
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i> <span class="small"> Change password</span>
          </a>
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
  <!-- /.navbar -->
    <!-- Main Sidebar Container -->
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="background:#001832">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-primary">
      <img src="<?= Yii::getAlias('@web/img/logo.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CIVE-eCLASSROOM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
      <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
      <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>
    <!-- /.sidebar-custom -->
  </aside>


    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6 float-right">
            <?= Breadcrumbs::widget([
              'homeLink'=>['label'=>'Dashboard', 'url'=>['/student/dashboard']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : ['Home'], 'options'=>['class'=>'float-sm-right']
            
        ]) ?>

          </div><!-- /.col -->
        </div><!-- /.row -->
        <!--Alert messages-->
        <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('success') ?></strong>
            </div>
          </div>
        </div>
      <?php endif ?>
       <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('error') ?></strong>
            </div>
          </div>
        </div>
      <?php endif ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <?= $content ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>


  <!-- footer -->
  <?= $this->render('/includes/footer') ?>
  <!-- footer end -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
