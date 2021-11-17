<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
/* @var $this yii\web\View */

$secretKey=Yii::$app->params['app.dataEncryptionKey'];
$cid=Yii::$app->getSecurity()->decryptByPassword($cid, $secretKey);

$this->title = 'class Dashboard';
$this->params['courseTitle'] = $cid." Dashboard";
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];

$secretKey=Yii::$app->params['app.dataEncryptionKey'];
$cid=Yii::$app->getSecurity()->encryptByPassword($cid, $secretKey);
?>
<div class="site-index">

    

    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
         
          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=Url::to(['/instructor/class-announcements','cid'=>$cid])?>">
            <div class="info-box">
              <span class="info-box-icon "><i class="fa fa-bullhorn"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Announcements</span>
           
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
          </div>

          <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3">
<a href="<?=Url::to(['/instructor/class-materials','cid'=>$cid])?>">
  <div class="info-box mb-3">
    <span class="info-box-icon "><i class="fas fa-book"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Materials</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</a>
</div>


          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=Url::to(['/instructor/class-assignments','cid'=>$cid])?>">
            <div class="info-box mb-3">
              <span class="info-box-icon"><i class="fas fa-book-reader"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Assignments</span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
</a>
          </div>
          <!-- /.col -->

        
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=Url::to(['/instructor/class-labs','cid'=>$cid])?>">
            <div class="info-box mb-3">
              <span class="info-box-icon "><i class="fas fa-microscope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lab Assignments</span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
</a>
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=Url::to(['/instructor/class-tutorials','cid'=>$cid])?>">
            <div class="info-box">
              <span class="info-box-icon "><i class="fas fa-chalkboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tutorials</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
</a>
          </div>
          <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3">
<a href="<?=Url::to(['/instructor/class-ext-assessments','cid'=>$cid])?>">
  <div class="info-box mb-3">
    <span class="info-box-icon"><i class="fa fa-file-alt"></i></span>

    <div class="info-box-content">
      <span class="info-box-text">Externals assessments</span>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</a>
</div>


          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=Url::to(['/instructor/class-ca-generator','cid'=>$cid])?>">
            <div class="info-box mb-3">
              <span class="info-box-icon"><i class="fas fa-cogs"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CA generator</span>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
</a>
          </div>
          <!-- /.col -->

        
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=Url::to(['/instructor/class-students','cid'=>$cid])?>">
            <div class="info-box mb-3">
              <span class="info-box-icon "><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Students</span>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
</a>
          </div>
          <!-- /.col 
          <div class="col-12 col-sm-6 col-md-3">
          <a href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1"><i class="fas fa-pen"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Quizes</span>
              </div>
             
            </div>
            
</a>
          </div>
           /.col -->

        <!--

          <div class="col-12 col-sm-6 col-md-3">
          <a href="/lecture/lecture-room">
            <div class="info-box mb-2">
              <span class="info-box-icon "><i class="fas fa-chalkboard-teacher"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Live lecturing</span>
              </div>
            
            </div>
            </a>
           
          </div>
          -->
<!--
          <div class="col-12 col-sm-6 col-md-3">
          <a href="#">
            <div class="info-box mb-2">
              <span class="info-box-icon elevation-1"><i class="fas fa-comments" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Class forum</span>
              </div>
            
            </div>
            </a>
        
          </div>
        
-->
        </div>
      </div><!--/. container-fluid -->

    </div>
</div>
<?php
$script = <<<JS
    $('document').ready(function(){

      ///select tag

   

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