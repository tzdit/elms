<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use yii\helpers\VarDumper;
/* @var $this yii\eb\View */

$this->params['courseTitle'] = '<i class="fa fa-th text-info"></i> Dashboard';
$this->title = 'Student Dashboard';
?>
<!-- <?= VarDumper::dump($courses) ?> -->
<div class="site-index">

    

    <div class="body-content">
   
        <div class="container-fluid">
        <div class="row">
        <?php foreach($courses as $course): ?>
            <?php
            $secretKey=Yii::$app->params['app.dataEncryptionKey'];
            $cid=Yii::$app->getSecurity()->encryptByPassword($course->course_code, $secretKey);

            ?>
          <div class="col-lg-3 col-6">
         
       
          <a href="<?=Url::to(['student/classwork/', 'cid'=>$cid])  ?>" class="small-box bg-info" >
          <?php
          $newscount=$course->getNewsCount();
          if($newscount>0)
          {
          ?>
          <span class="nav-link float-right" data-toggle="dropdown" href="#" style="position:absolute;right:0">
          <span class="badge badge-danger navbar-badge"><?=$newscount?></span>
        </span>
        <?php
          }
        ?>
              <div class="inner">
                <h3><?= $course->course_code ?></h3>

                <p class="m-0">Credit <?= $course->course_credit ?></p>
                <h5 class="m-0 p-0 text-muted"> <?= strtoupper($course->course_status) ?></h5>
              </div>

              <div class="icon">
                <i class="mt-n4"><img src="<?= Yii::getAlias('@web/img/course.png') ?>"></i>

              </div>
    
            </a>
          </div> 
          <?php endforeach ?>
        </div>
      </div>

    </div>
</div>

<?php 
$script = <<<JS
$(document).ready(function(){


  
})
JS;
$this->registerJs($script);
?>

