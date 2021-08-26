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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelementplayer.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/jump-forward/jump-forward.min.css" integrity="sha512-vHovrDslh/SZPpxgZqaPdU1/wLSaS015uMYHkCn7M2Te2o6edMJ5kk1Hmjy7LPXkMQyvpkfhgaP5X7C2cyuiPQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/skip-back/skip-back.min.css" integrity="sha512-sHVQCj7ahO15WmjKUqD0AAUNu8WWw2tpLM6MS79tysxdxXPqbAMZrrfI3tOreK6zcM4LxVH/asUEdQ1RnAhV6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/airplay/airplay.min.css" integrity="sha512-WFZbCYRtVA0KtJDNwzADb3r3ProD/T8MWwtdYTxzLtEQOTb6imgz19kP4Lfam11En/WTTHGaJtN1I8IYPC8oFg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/context-menu/context-menu.min.css" integrity="sha512-0tMNRS8a8sUxculnEHe+nBLWbSJPsiHI4YaaupqEpv7s7X6VaUxtqmqdG8WcuMvOpY1bSNSszdL8gZuJ7cGT9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/context-menu/context-menu.min.css" integrity="sha512-0tMNRS8a8sUxculnEHe+nBLWbSJPsiHI4YaaupqEpv7s7X6VaUxtqmqdG8WcuMvOpY1bSNSszdL8gZuJ7cGT9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelement-and-player.min.js" integrity="sha512-hLCA6qoEOSjwOEIc6xi7p0g6/uW2SAqS7gGZIxfN4jYabdJVsW7ANuUeih/vRrU3nGpf9cnsadaC+W3qoDqIQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/jump-forward/jump-forward.min.js" integrity="sha512-C0d4gm7678yhqNgSYXd14/1EZ/CE1QgubhVs8r7iLKl+ElSjzCNVrpSYwW8C+V6q/qHUJ1ZDos4g6Kmpw5uMjA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/skip-back/skip-back.min.js" integrity="sha512-MRqijnTHZOc7Nxy7cbVb81q6cMP48Z9yS0xv/cmBq0Y4q1MoL5toFSckjsW42SfD3/If27aIaq/v6tVCwmDOFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/airplay/airplay.min.js" integrity="sha512-q18A9OHcyp4bXsGsJitgyx4A9EIL7FWV11HMrm/Tb5xrStI3YLBF0o6Bc7iPT5ipfIsVpS7pbNzkAdEUkpGayA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement-plugins/2.5.1/context-menu/context-menu.min.js" integrity="sha512-SCF51k9SJUZXsQbbiqzjE7SwsbS/Nbt8upzpl1Cboen7sVisv3BTrDjlCPBLihM8fbTBwwGSM4QJdBH3n+vmEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<script>
    $('video').mediaelementplayer({
      features: ['playpause','current','progress','duration','volume','trucks','preview','airplay','jumpforward','skipback','fullscreen','contextmenu']
    });
</script>


</body>
</html>
<?php $this->endPage() ?>
