<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Student Dashboard';
?>
<div class="site-index">
  <div class="body-content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
                  <div class="row">
                        <div class="col-lg-3 col-6">
            <!-- small box -->
                             <div class="small-box bg-info">
                                       <div class="inner">
                                          <h3>TN 330</h3>
                                          <p>8 Credits</p>
                                       </div>

                                       <div class="icon">
                                          <i class="ion ion-bag"></i>
                                       </div>
                                  <a href="<?=Url::to(['student/classwork/'])?>"  class="small-box-footer">Enter <i class="fas fa-arrow-circle-right"></i></a>
                             </div>
                         </div>
                   </div>
         </div>
    </div>
</div>
