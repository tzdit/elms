<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\helpers\Custom;
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
          <a href="<?=Url::to(['instructor/classwork/', 'cid'=>$course->course_code])  ?>" style="color:white">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $course->course_code ?></h3>

                <p><?= $course->course_credit ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <div class="small-box-footer container" >
              <div class="row" > 
              <div class="col-sm-6">
              <a href="<?=Url::to(['instructor/classwork/', 'cid'=>$course->course_code])  ?>" style="color:white">Enter <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <div class="col-sm-6">
              <a href="#" class=" drop " style="color:white" data-toggle="tooltip" data-title="Drop this course"  ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-times-circle">drop</i></a>
              </div>
              </div>
              </div>
            </div>
            </a>
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
<?php
$script = <<<JS
    $('document').ready(function(){
    //sweetalert start here
    $(document).on('click', '.drop', function(){
      var ccode = $(this).attr('ccode');
 

      Swal.fire({
  title: '<small>Do you want to drop this course?</small>',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Drop it!'
    }).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/dropcourse',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{ccode:ccode},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Droped!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    }, 1500);
   

        }
      }
    })
   
  }
    })

    });

  })



  JS;
$this->registerJs($script);
?>