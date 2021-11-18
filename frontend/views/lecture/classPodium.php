<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\models\Assignment;
use yii\helpers\ArrayHelper;
use common\models\LiveLecture;
use frontend\models\LectureRoom;

$cid=yii::$app->session->get('ccode');
//$this->params['courseTitle'] = $cid." Lecture Room";
//$this->title =$cid." Lecture Room";
$this->params['breadcrumbs'] = [
  ['label'=>'class dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
         
           <?php    print $address; ?>
    <iframe src="<?=$address?>" style="position:absolute;height:100%;width:100%">
  

    </iframe>
    <!-- <div id="viewpdf"></div> -->


</div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  
  $('.info-box').hover(function(){
      $(this).css('border-radius','6px');
      $(this).css('box-shadow','5px 10px 18px #888888');

      },
      function(){
        $(this).css('border-radius','none');
        $(this).css('box-shadow','none');
        $(this).css('color','none');
     

      });


      
});
JS;
$this->registerJs($script);

?>
