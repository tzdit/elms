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
    $this->registerLinkTag(['rel' => 'icon', 'type' => '/image/png', 'href' => '/logo.png']);
     ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-info"><img src="/img/dit-logo.png" style="width:13%;height:5%;"><snap >DIT|eLMS</snap></h2>
        </a>
    </nav>
  <div class="card card-outline card-info">
     <div class="row">
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
       <div class="row d-flex justify-content-center" style="background-image:url(/img/landing_page1.jpg);background-repeat: no-repeat; width:100%" >
     
        <div class="col-sm-8 d-flex justify-content-center text-info" style="overflow-wrap: break-word; ">


        <!-- short course ads carousel-->


          <?php if($ads==null){?>
          <span class=" text-bold text-info text-center" style="position:absolute;bottom:50%;font-size:50px">WELCOME TO DIT eLEARNING MANAGEMENT SYSTEM</span>
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
                      <div class="row"><div class="col-sm-12 text-bold text-light text-sm-sm" style="font-size:35px"><?=$ad->title?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold text-light" style="font-size:30px"><?=$ad->description?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold text-light" style="font-size:25px">Mwisho wa usajili (Registration Deadline): <?=date_format(date_create($ad->deadlinedate),'d-m-Y')?> <?=$ad->deadlinetime?></div></div>
                      <div class="row mt-3" ><div class="col-sm-12 text-bold text-light" style="font-size:25px"><a href="<?=Url::to(['/student/register','course'=>ClassRoomSecurity::encrypt($ad->course_code)])?>" class="btn btn-default border" ><i class="fa fa-graduation-cap text-info"></i> Register Now</a></div></div>

                   </div>
              </div>
          <?php }else{ ?>
          <div class="carousel-item">
          <div class="container-fluid d-flex justify-content-center">
            <img src="/img/newblink.gif" class="img-circle"  style="width:100px;height:100px;margin-bottom:1%"></img>
               </div>
          <div class="container text-center">
                      <div class="row"><div class="col-sm-12 text-bold text-light" style="font-size:40px"><?=$ad->title?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold text-light" style="font-size:30px"><?=$ad->description?></div></div>
                      <div class="row"><div class="col-sm-12 text-bold text-light" style="font-size:25px">Mwisho wa usajili (Registration Deadline): <?=date_format(date_create($ad->deadlinedate),'d-m-Y')?> <?=$ad->deadlinetime?></div></div>
                      <div class="row mt-3"><div class="col-sm-12 text-bold text-light" style="font-size:25px"><a href="<?=Url::to(['/student/register','course'=>ClassRoomSecurity::encrypt($ad->course_code)])?>" class="btn btn-default border" ><i class="fa fa-graduation-cap text-info"></i> Register Now</a></div></div>

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
<div class="login-box mt-5 ml-3">
  <!-- /.login-logo -->
<?= $content ?>
</div>

</div>
</div>

</div>
<div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <div class="card card-outline card-info shadow col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-info mb-4"></i>
                            <h5 class="mb-3">Assignments</h5>
                            <p>Platform Allows lectures to create Assignments for students and students to perform and submit their theory and practical Assignment in the platform </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    
                    </div>
                <div class="card card-outline card-info shadow col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-globe text-info mb-4"></i>
                            <h5 class="mb-3">Online Lectures</h5>
                            <p>Allows students to attend lecture from any where they are and lectures to conducts Lecture for a large number of students from any where</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    
                </div>
                <div class="card card-outline card-info shadow col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-file text-info mb-4"></i>
                            <h5 class="mb-3">Quizes</h5>
                            <p>The platform  Enable lectures to create test and mark it on the platform as well as Allows students to take quize and submit it in a limited time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="/img/icon.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-info pe-3">News and Updates</h6>
                    <h1 class="mb-4">News</h1>
                    <p class="mb-4"></p>
                    <a class="btn btn-info py-3 px-5 mt-2" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>   
<!-- the footer -->
<div class="container-fluid bg-info">
  <br/>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <p class="mb-2"><a class="btn btn-link text-light" href="">Soma</a></p>
                    <p class="mb-2"><a class="btn btn-link text-light" href="">DIT website</a></p>
                    <p class="mb-2"><a class="btn btn-link text-light" href="">FAQs & Help</a></p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Bibititi and Morogoro Rd Junction
                      </p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>  P. O. Box 2958<br/> Dar-es-salaam, Tanzania</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>principal@dit.ac.tz</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="/img/online-courses-concept_23-2148524391.webp" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="/img/online.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="/img/online.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="/img/online-courses-concept_23-2148524391.webp" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="/img/online.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="/img/course-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="container-fluid">
            <hr/>
        <br/>
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <footer  class="d-none d-lg-block d-md-block d-xl-block d-xxl-block text-white text-center" style="position:absolute;bottom:2%">Copyright &copy; <?=date('Y')?> &nbsp DIT eLearning Management System.</footer>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div>
</div>


<!-- /.login-box -->
<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>
