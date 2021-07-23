<?php
use yii\bootstrap4\Breadcrumbs;

use yii\helpers\Url;
use yii\helpers\Html;

?>

<!-- <?=  
var_dump($announcement);
die();
?> -->

<div class="card card-info  text-center">
            <div class="card-header">
                 Announcement
              </div>

              <div class="card-body p-0 border-bottom-0">
            
                <h5 class="card-title"><?php $announcement->title;  ?></h5>
                <p class="card-text"><?php $announcement->content;  ?></p>
            </div>

            <div class="card-footer text-muted">
            <?php echo Yii::$app->formatter->asRelativeTime($announcement->ann_date." ".$announcement->ann_time) ?>
           </div>
</div>