<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\ClassRoomSecurity;
use common\models\Instructor;
use frontend\models\AddPartner;

/* @var $this yii\web\View */
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] ='<img src="/img/external.png" height="25px" width="25px"/> '.$cid. " Externals";
$this->title ="Externals";
$this->params['breadcrumbs'] = [
  ['label'=>$cid." Dashboard", 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
  ['label'=>$this->title]
];
///////////////////////////////////////


?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 ">
       
     <?php 
  

     //participating programs

       
       
       ?>
        
         
              <!-- /////////////////////////////////////////// -->

                  <div class="tab-content" id="custom-tabs-four-tabContent">
                                <!-- ########################################### Course materials ######################################## -->
                             <?php 
                             if($externals==null || empty($externals))
                             {
                              ?>
                              <div class="jumbotron"><i class="fa fa-info-circle text-warning"></i> No published External Assessment</div>
                              <?php
                             }
                             else
                             {
                              ?>
                                <div class="accordion" id="accordionExample_3">
                                    <?php foreach( $externals as $index=>$external ) : ?>
                                      
                                            <div class="card shadow-lg">
                                                <div class="card-header p-2">
                                                    <h2 class="mb-0">
                                                        <div class="row ">
                                                            <div class="col-sm-11">
                                                                <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                                                                 <?=$external->title?>
                                                                </button>
                                                                <div class="col d-flex justify-content-center">
                                                                <div class="card shadow text-center" style="width:40%" >
                                                                  <div class="card-header responsivetext">
                                                                    <?php 

                                                                    $studentscore=$external->findStudentScore();
                                                                    if($studentscore==null){
                                                                    ?>
                                                                    <span class="text-danger" data-toggle="tooltip" data-title="Assessment Failed">Inc</span>
                                                                    <?php
                                                                     } 
                                                                     else
                                                                     { 
                                                                    if((($studentscore->score*40)/$external->total_marks)<15.5)
                                                                    {
                                                                      ?>
                                                                        <span class="text-danger" data-toggle="tooltip" data-title="Assessment Failed"><?=$studentscore->score?></span>
                                                                      <?php
                                                                    }
                                                                    else
                                                                    {
                                                                      ?>
                                                                      <span class="text-success " data-toggle="tooltip" data-title="Assessment succeeded"><?=$studentscore->score?></span>
                                                                      <?php
                                                                    }
                                                                  }
                                                                      ?>
                                                                  </div>
                                                                  <div class="card-body responsivetext">
                                                                  <?=$external->total_marks?>
                                                                  </div>
                                                                 </div></div>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                </div></div>

          
          
      

<?php 
endforeach;

                             }
 ?>


              <!-- ////////////////////////////////////////// -->
              
    </div>
    </div>
</div>

</section>
          
</div>

      </div><!--/. container-fluid -->

    </div>
</div>
</div>

                
    



<?php 
$script = <<<JS
$(document).ready(function(){
  $('#assignstudents').select2();
  $('#remstudents').select2();
  $(".headcard").on('show.bs.collapse','.collapse', function(e) {
  $(e.target).parent().addClass('shadow');
  });
  $(".headcard").on('hidden.bs.collapse','.collapse', function(e) {
  $(e.target).parent().removeClass('shadow');
  });
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  //$("#studenttable").DataTable({
    //responsive:true,
  //});
  
  $('#studenttable').DataTable( );

})

JS;

$this->registerJs($script);

?>
