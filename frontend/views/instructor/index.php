<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
/* @var $this yii\web\View */

$this->title = 'Instructor Dashboard';
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
        <div class="container-fluid">
     
        <div class="row">
        <?php foreach($courses as $course): ?>
          <div class="col-lg-3 col-6">
       
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $course->course_code ?></h3>

                <p><?= $course->course_credit ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?=Url::to(['instructor/classwork/', 'cid'=>$course->course_code])  ?>"  class="small-box-footer">Enter <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <!-- <div class="col-lg-3 col-6">
          
            <div class="small-box bg-success">
              <div class="inner">
                <h3>CS 120<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Enter <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <div class="col-lg-3 col-6">
           
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>BT 220</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Enter <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
         
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Enter <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
         -->
          <?php endforeach ?>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->

    </div>
</div>
