<?php
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Security;
use common\models\Assignment;
use yii\helpers\ArrayHelper;

$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] = $cid." Lecture Room";
$this->title =$cid." Lecture Room";
$this->params['breadcrumbs'] = [
  ['label'=>'class dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="jumbotron" style="background-color:rgba(40,50,150,.05)">
         <div class="row" >
         <div class="col-md-12 text-center" >

         <i class="fa fa-school" style="font-size:50px;color:rgba(70,100,255,.6)"></i><br><span style="font-size:25px"><?=$cid." Lecture Room"?></span>

         </div>
</div>

<div class="row" style="background-color:rgba(10,30,200,.1);">
         <div class="col-md-6" style="background-color:rgba(254,254,254,.8);">
         <span class='float-right'>25 sessions</span>
         </div>

         <div class='col-md-6' style="background-color:rgba(254,254,254,.8);border-left:solid 2px #ccc">

         <span class='float-left'><i class='fa fa-plus-circle'></i><a href="" >New Session</a></span>
         
         </div>


</div>
      
    </div>
    <div class='container-fluid '>
      <div class="row d-flex justify-content-center">

      <div class="col-12 col-sm-6 col-md-3" >
          <a href="#">
            <div class="info-box mb-2 " style="border:none;box-shadow:none">
              <span class="info-box-icon"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Class forum</span>
              </div>
            
            </div>
            </a>
        
          </div>

          <div class="col-12 col-sm-6 col-md-3" >
          <a href="#">
            <div class="info-box mb-2 " style="border:none;box-shadow:none">
              <span class="info-box-icon"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Class forum</span>
              </div>
            
            </div>
            </a>
        
          </div>

</div>

</div>

    </div>
</div>
</div>
   
 



<?php
//the module creating
//$modulemodel = new Module();
//$this->render('module/_form', ['modulemodel'=>$modulemodel, 'ccode'=>$cid]) 
?>


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
