<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use yii\helpers\VarDumper;
/* @var $this yii\eb\View */

$this->params['courseTitle'] = 'Classes';
$this->title = 'Student Dashboard';
?>
<!-- <?= VarDumper::dump($courses) ?> -->
<div class="site-index">

    

    <div class="body-content">
   
        <div class="container-fluid">
     
        <div class="row">
        <?php foreach($courses as $course): ?>
          <div class="col-lg-3 col-6">
          <a href="<?=Url::to(['student/classwork/', 'cid'=>$course->course_code])  ?>" class="small-box bg-info" >
          
              <div class="inner">
                <h3><?= $course->course_code ?></h3>

                <p class="m-0">Credit <?= $course->course_credit ?></p>
                <h5 class="m-0 p-0 text-muted"> <?= strtoupper($course->course_status) ?></h5>
              </div>

              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
    
            </a>
          </div> 
          <?php endforeach ?>
        </div>
      </div>

    </div>
</div>
