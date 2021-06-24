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
use common\widgets\Course;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-fixed-layout layout-navbar-fixed">
<?php $this->beginBody() ?>

<div class="wrapper">
     <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo Yii::getAlias('@web/img/logo.png'); ?>" alt="LOGO" height="60" width="60">
  </div> -->
     <!-- Navbar -->
  <?= $this->render('/includes/header') ?>
  <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <!-- also this you may trie these 082B45  # #0062CC-->
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4 pace-primary" style="background:#001832">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-primary">
      <img src="<?= Yii::getAlias('@web/img/logo.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CIVE-eCLASSROOM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
  
      <!-- Sidebar Menu -->
      <?= $this->render('/includes/sidebar') ?>
    <!-- /.sidebar-custom -->
  </aside>


    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header border-bottom p-2 show-sm">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 text-secondary font-weight-bold" style="font-family:'Times New Roman'; font-size:20px;">
           <?= Course::widget([
             'courseTitle'=>isset($this->params['courseTitle'])? $this->params['courseTitle']: ''
           ])?>
          </div><!-- /.col -->
          <div class="col-sm-6 float-right">
           <?= Breadcrumbs::widget([
              'homeLink'=>['label'=>'Dashboard', 'url'=>['/home/dashboard']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [''],
            'options'=>['class'=>'float-sm-right']
        ]) ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <!--Alert messages-->
    </div>
    <!-- /.content-header -->
    </div><!-- /.container-fluid -->
      <div class="container mt-2 show-sm">
      <div class="row">
      <div class="col-md-12">
      <?php if(Yii::$app->session->hasFlash('success')): ?>

          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('success') ?></strong>
            </div>
          </div>
      
      <?php endif ?>
       <?php if(Yii::$app->session->hasFlash('error')): ?>
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('error') ?></strong>
            </div>
          </div>
        
      <?php endif ?>
      <?php if(Yii::$app->session->hasFlash('info')): ?>
          <div class="col-md-12">
            <div class="alert alert-info alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('info') ?></strong>
            </div>
          </div>
        
      <?php endif ?>
      </div>
      
      </div>
      </div>

    <!-- Main content -->
    <section class="content mt-3">
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
