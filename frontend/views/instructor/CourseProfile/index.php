<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
/* @var $this yii\web\View */

$secretKey=Yii::$app->params['app.dataEncryptionKey'];
//$cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

$this->title = $cid.' Dashboard';
$this->params['courseTitle'] = "<i class='fas fa-th'></i> ".$cid." Dashboard";
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];

?>
    <div class="site-index">



        <div class="body-content">
            <!-- Content Wrapper. Contains page content -->

            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">

                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/class-assignments','cid'=>$cid])?>">
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-book-reader"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Assignment(s): [<?= $AssignmentCount;?>]</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/class-labs','cid'=>$cid])?>">
                            <div class="info-box mb-3">
                                <span class="info-box-icon"><i class="fas fa-microscope"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Lab(s): [<?= $LabCount;?>]</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/class-materials','cid'=>$cid])?>">
                            <div class="info-box mb-3">
                                <span class="info-box-icon "><i class="fas fa-book"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Material(s): [<?= $MaterialCount;?>]</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/class-announcements','cid'=>$cid])?>">
                            <div class="info-box">
                                <span class="info-box-icon "><i class="fa fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Announcement(s): [<?= $AnnouncementCount;?>]</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>

                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/class-ext-assessments','cid'=>$cid])?>">
                            <div class="info-box mb-3">
                                <span class="info-box-icon"><i class="fa fa-file-alt"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">External assessment(s): [<?= $ExtAssessmentCount;?>]</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/class-students','cid'=>$cid])?>">
                            <div class="info-box mb-3">
                                <span class="info-box-icon "><i class="fas fa-user-graduate"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Student(s): [<?= $StudentCount;?>]</span>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="<?=Url::to(['/instructor/partners'])?>">
                            <div class="info-box mb-2">
                                <span class="info-box-icon "><i class="fas fa-user-friends" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Instructor(s): [<?= $InstructorCount;?>]</span>
                                </div>
                            </div>
                        </a>

                    </div>

                </div>
            </div><!--/. container-fluid -->

        </div>
    </div>
<?php
$script = <<<JS
    $('document').ready(function(){

      ///select tag

      $('.info-box').css('border-radius','none');
      $('.info-box').css('box-shadow','none');
      $('.info-box').css('color','none');

      //the dropdown searcn adding partner

   
      $('.info-box').hover(function(){
      $(this).css('border-radius','6px');
      $(this).css('box-shadow','5px 10px 18px #888888');

      },
      function(){
        $(this).css('border-radius','none');
        $(this).css('box-shadow','none');
        $(this).css('color','none');
     

      });

      //the inputs lists

      $('.info-box').hover(function(){
      $(this).css('backgroundColor','#eef');
      $(this).css('border-radius','6px');
      $(this).css('box-shadow','5px 10px 18px #888888');

      },
      function(){
        $(this).css('backgroundColor','');
        $(this).css('border-radius','none');
        $(this).css('box-shadow','none');
        $(this).css('color','none');
     

      });
   
 

  })
JS;
$this->registerJs($script);
?>