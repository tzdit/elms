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
              
                <!-- start -->
            <div class="row">
            <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username"><?= $courseName ;?></h3>
                <h5 class="widget-user-desc"><?= $this->title = $cid ;?></h5>
              </div>
              <div class="widget-user-image">
              <img class="animation__shake" src="<?php echo Yii::getAlias('@web/img/book4.png'); ?>" alt="book" height="60" width="60">
              </div>
              <div class="card-footer">
                <div class="row">
                <?php
                    $secretKey=Yii::$app->params['app.dataEncryptionKey'];
                    $cid=Yii::$app->getSecurity()->encryptByPassword($cid, $secretKey);
                    ?>
                
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/class-assignments','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $AssignmentCount;?></h5>
                      <span class="description-text"><i class="fas fa-book-reader"></i> ASSIGNMENT(S)</span>
                    </div>
                    </a>
                    <!-- /.description-block -->
                  </div>
                
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/class-tutorials','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $TutorialCount;?></h5>
                      <span class="description-text"><i class="fas fa-chalkboard"></i> TUTORIAL(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/class-labs','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $LabCount;?></h5>
                      <span class="description-text"><i class="fas fa-microscope"></i> LAB(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/class-materials','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $MaterialCount;?></h5>
                      <span class="description-text"><i class="fas fa-book"></i> MATERIAL(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/partners'])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $InstructorCount;?></h5>
                      <span class="description-text"><i class="fas fa-user-friends" aria-hidden="true"></i> INSTRUCTOR(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/class-announcements','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $AnnouncementCount;?></h5>
                      <span class="description-text"><i class="fas fa-book"></i> ANNOUNCEMENT(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 border-right">
                  <a href="<?=Url::to(['/instructor/class-ext-assessments','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $ExtAssessmentCount;?></h5>
                      <span class="description-text"><i class="fas fa-book"></i> EXTERNAL ASSESSMENT(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                  <a href="<?=Url::to(['/instructor/class-students','cid'=>$cid])?>">
                    <div class="description-block">
                      <h5 class="description-header"><?= $StudentCount;?></h5>
                      <span class="description-text"><i class="fas fa-user-graduate"></i> STUDENT(S)</span>
                    </div>
                  </a>
                    <!-- /.description-block -->
                  </div>
                  
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->
</div>

                <!-- end -->
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