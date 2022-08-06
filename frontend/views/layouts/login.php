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
use common\models\ShortcourseAdvert;
use frontend\models\ClassRoomSecurity;
//use Yii;

AppAsset::register($this);

$ads=ShortcourseAdvert::find()->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php 
    $this->registerCsrfMetaTags();
    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/logo.png']);
     ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
</head>
<body class="p-5" style="background-image:url('/img/ditmain.jpg')!important; background-color: rgba(0, 0, 70, 0.6);
 background-blend-mode: soft-light;background-repeat:no-repeat;background-size:100%">
<div class="container ">
     <div class="row mt-3 show-sm">
      <?php if(Yii::$app->session->hasFlash('success')): ?>

          <div class="col-md-12 text-center">
            <div class="alert alert-success alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('success') ?></strong>
            </div>
          </div>
      
      <?php endif ?>
       <?php if(Yii::$app->session->hasFlash('error')): ?>
          <div class="col-md-12 text-center">
            <div class="alert alert-danger alert-dismissible">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              <strong><?= Yii::$app->session->getFlash('error') ?></strong>
            </div>
          </div>
        
      <?php endif ?>
       </div>
       </div>
       <div class="row d-flex justify-content-center">
     
        <div class="col-sm-8 d-flex justify-content-center text-white" style="overflow-wrap: break-word;">


        <!-- short course ads carousel-->


          <?php if($ads==null){?>
          <span class=" text-bold text-white text-center" style="position:absolute;bottom:50%;font-size:50px">WELCOME TO DIT eLEARNING MANAGEMENT SYSTEM</span>
          <?php } ?>
   
           <!-- short course ads carousel-->

              <div id="ad" class="carousel slide mt-5" data-ride="carousel" style="font-size:50px">

          

                <!-- The slideshow -->
                <div class="carousel-inner " >
          <?php
          $count=0;
            foreach($ads as $ad)
            {
              if($count==0)
              {
          ?>
 
              <div class="carousel-item active">
              <div class="container-fluid d-flex justify-content-center">
            <img src="/img/newblink.gif" class="img-circle"  style="width:100px;height:100px;margin-bottom:1%"></img>
               </div>
                   <div class="container text-center">
                      <div class="row"><div class="col-sm-12 text-bold" style="font-size:40px"><?=$ad->title?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold" style="font-size:30px"><?=$ad->description?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold" style="font-size:25px">Registration Deadline: <?=date_format(date_create($ad->deadlinedate),'d-m-Y')?> <?=$ad->deadlinetime?></div></div>
                      <div class="row mt-3" ><div class="col-sm-12 text-bold" style="font-size:25px"><a href="<?=Url::to(['/student/register','course'=>ClassRoomSecurity::encrypt($ad->course_code)])?>" class="btn btn-default border" ><i class="fa fa-graduation-cap"></i> Register Now</a></div></div>

                   </div>
              </div>
          <?php }else{ ?>
          <div class="carousel-item">
          <div class="container-fluid d-flex justify-content-center">
            <img src="/img/newblink.gif" class="img-circle"  style="width:100px;height:100px;margin-bottom:1%"></img>
               </div>
          <div class="container text-center">
                      <div class="row"><div class="col-sm-12 text-bold" style="font-size:40px"><?=$ad->title?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold" style="font-size:30px"><?=$ad->description?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold" style="font-size:25px">Registration Deadline: <?=date_format(date_create($ad->deadlinedate),'d-m-Y')?> <?=$ad->deadlinetime?></div></div>
                      <div class="row mt-3"><div class="col-sm-12 text-bold" style="font-size:25px"><a href="#" class="btn btn-default border" ><i class="fa fa-graduation-cap"></i> Register Now</a></div></div>

                   </div>
              </div>

          <?php
          
            }
            $count++;
          }
          ?>
          </div>
      
            </div>

            <!-- end of carousel for short courses -->
        </div>
        <div class="col-sm-4">
<div class="login-box mt-5">
  <!-- /.login-logo -->
<?= $content ?>


</div>
<!-- the footer -->
<footer  class="d-none d-lg-block d-md-block d-xl-block d-xxl-block text-white text-center" style="position:absolute;bottom:2%">
Copyright &copy; <?=date('Y')?> &nbsp DIT eLearning Management System.
  </footer>
</div>

<!-- /.login-box -->
<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>
