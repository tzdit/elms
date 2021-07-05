<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\helpers\Custom;
use common\models\Instructor;
use frontend\models\AddPartner;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
$this->params['courseTitle'] = "My courses";
$this->title = 'Instructor Dashboard';
$instructorid=Yii::$app->user->identity->instructor->instructorID;
 //finding all instructors
$instructors=ArrayHelper::map(Instructor::find()->asArray()->where(['<>','instructorID',$instructorid])->all(),'instructorID','full_name');

?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
        <div class="container-fluid">
     
        <div class="row">
        <?php foreach($courses as $course): ?>
          <div class="col-lg-3 col-6">
          <a href="<?=Url::to(['instructor/classwork/', 'cid'=>$course->course_code])  ?>" style="color:white">
            <div class="small-box bg-info"  >
              <div class="inner" style="padding:10px" data-toggle="tooltip" data-title="Enter this course">
                <h4 ><?= $course->course_code ?></h4>

                <p><?= $course->course_credit ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <div class="small-box-footer container" >
              <div class="row" > 
              <div class="col-sm-6">
              <a href="#" class=" drop " style="color:white" data-toggle="tooltip" data-title="Drop this course"  ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-times-circle"></i></a>
              </div>
              <div class="col-sm-6">
              <a href="#" class=" " style="color:white"  data-target="#myModal<?=str_replace(" ","",$course->course_code)?>" data-toggle="modal" data-tooltip="tooltip" data-title="Add partner"  ccode="<?= $course->course_code ?>" cname="<?= $course->course_name ?>"><i class="fas fa-user-plus"></i></a>
              </div>
              </div>
              </div>
            </div>
            </a>
          </div>
          <?php 
          
          $partner = new AddPartner();
          ?>
          <?= $this->render('add_partner',['partners'=>$partner,'instructors'=>$instructors,'cid'=>$course->course_code]) ?>
          <?php endforeach ?>

        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
       <!-- add partner modal -->

        
    </div>
  </div>

    </div>
</div>

<script>
   $(".myselect").select2({
     theme:'classic'
   });
    $('document').ready(function(){

      ///select tag

   

      //the dropdown searcn adding partner

      $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
      $('.small-box').hover(function(){
      $(this).css('border','solid 0.5px #dda');
      $(this).css('color','yellow');
      $(this).css('border-radius','6px');
      $(this).css('box-shadow','5px 10px 18px #888888');

      },
      function(){
        $(this).css('border','none');
        $(this).css('border-radius','none');
        $(this).css('box-shadow','none');
        $(this).css('color','none');
     

      });

      //the inputs lists

      $('.item').hover(function(){
      $(this).css('backgroundColor','#dde');
      $(this).css('color','yellow');
      $(this).css('border-radius','6px');
      $(this).css('box-shadow','5px 10px 18px #888888');

      },
      function(){
        $(this).css('backgroundColor','');
        $(this).css('border','none');
        $(this).css('border-radius','none');
        $(this).css('box-shadow','none');
        $(this).css('color','none');
     

      });
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
</script>

 <style>
  #myInput {
    padding: 20px;
    margin-top: -6px;
    border: 0;
    border-radius: 0;
    background: #f1f1f1;
  }
  </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

