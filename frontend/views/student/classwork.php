<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use common\models\Material;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\Submit;
use frontend\models\UploadMaterial;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Classwork'; 
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/student/classwork', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-forum" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="true">Forum</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-assessments" data-toggle="tab" href="#assessment" role="tab" aria-controls="assessments" aria-selected="false">Assignments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-labs" data-toggle="tab" href="#labs" role="tab" aria-controls="labs" aria-selected="false">labs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-tutorials" data-toggle="tab" href="#tutorials" role="tab" aria-controls="tutorials" aria-selected="false">tutorials</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-coursematerials" data-toggle="tab" href="#coursematerials" role="tab" aria-controls="coursematerials" aria-selected="false">Course materials</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-returned" data-toggle="tab" href="#returned" role="tab" aria-controls="returned" aria-selected="false">Returned</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-Announcements" data-toggle="tab" href="#announcements" role="tab" aria-controls="announcements" aria-selected="false">Announcements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-quiz" data-toggle="tab" href="#quiz" role="tab" aria-controls="quiz" aria-selected="false">Quiz</a>
                  </li>
                </ul>
              
              </div>
             
              <div class="card-body">
             
                <div class="tab-content" id="custom-tabs-four-tabContent">

<!-- ########################################### forum work ######################################## --> 
                  <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                    WASHA KAZI KAMA MOTO
                  </div>  

<!-- ########################################### Assigments and Labs ######################################## --> 
<?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->count(); ?>      
<div class="tab-pane fade" id="assessment" role="tabpanel" aria-labelledby="custom-tabs-assignment">
<div class="accordion" id="accordionExample">
<?php $assk = "Assignment".$ass ;
$assk = "Assignment".$ass;
?>
<?php foreach( $assignments as $assign ) : ?>

  <div class="card">
    <div class="card-header p-2" id="heading<?=$ass?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$ass?>" aria-expanded="true" aria-controls="collapse<?=$ass?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Assignment ".$ass;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$ass?>" class="collapse" aria-labelledby="heading<?=$ass?>" data-parent="#accordionExample">
      <div class="card-body">
         <p><span style="color:green"> About: </span>  <?= $assign -> assName ?> </p>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-8">
      <b> Deadline : </b><?= $assign -> finishDate ?>
      </div>
      <div class="col-md-4">


        <?php 
        $submited = Submit::find()->where('reg_no = :reg_no AND assID = :assID', [ ':reg_no' => $reg_no,':assID' => $assign->assID])->all(); 
        ?>

        <?php  
                // check if dead line of submit assinemnt is meeted 
              $deadLineDate = new DateTime($assign->finishDate);
              $currentDateTime = new DateTime("now");

              $isOutOfDeadline =   $currentDateTime > $deadLineDate;
              ?>

        <?php if(empty($submited) && $isOutOfDeadline == false):?>
      <a href="<?= Url::toRoute(['/student/submit_assignment','assID'=> $assign->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
        <?php endif ?>

        <?php if(!empty($submited) && $isOutOfDeadline == false):?>
          <a href="<?= Url::toRoute(['/student/resubmit','assID'=> $assign->assID])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
        <?php endif ?>

        <?php if($isOutOfDeadline == true):?>
          <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
        <?php endif ?>

      <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $assign->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>
      <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $assign->assID])?>" class="btn btn-sm btn-info float-right"><span><i class="fas fa-eye"> View</i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $ass--;
        
        ?>
  
  <?php endforeach ?>


</div>

</div>

<?php $labb = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->count(); ?>
<!-- ########################################### lab work ######################################## -->

<div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="custom-tabs-lab">
<div class="accordion" id="accordionExample_3">
<?php foreach( $labs as $lab ) : ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$labb?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$labb?>" aria-expanded="true" aria-controls="collapse<?=$labb?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Lab ".$labb;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$labb?>" class="collapse" aria-labelledby="heading<?=$labb?>" data-parent="#accordionExample_3">
      <div class="card-body">
      <p><span style="color:green"> About: </span> <?= $lab -> assName ?></p>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-8 float-left">
      <b> Deadline : </b> <?= $lab -> finishDate ?>
      </div>
      <div class="col-md-4">


              <?php 
                $submited = Submit::find()->where('reg_no = :reg_no AND assID = :assID', [ ':reg_no' => $reg_no,':assID' => $lab->assID])->all(); 
                ?>

                <?php  
                        // check if dead line of submit assinemnt is meeted 
                      $deadLineDate = new DateTime($lab->finishDate);
                      $currentDateTime = new DateTime("now");

                      $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                      ?>

                <?php if(empty($submited) && $isOutOfDeadline == false):?>
              <a href="<?= Url::toRoute(['/student/submit_assignment','assID'=> $lab->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                <?php endif ?>

                <?php if(!empty($submited) && $isOutOfDeadline == false):?>
                  <a href="<?= Url::toRoute(['/student/resubmit','assID'=> $lab->assID])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                <?php endif ?>

                <?php if($isOutOfDeadline == true):?>
                  <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                <?php endif ?>

              <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $lab->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

              <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $lab->assID])?>" class="btn btn-sm btn-info float-right"><span><i class="fas fa-eye"> View</i></span></a>



      </div>
      </div>
      </div>
    </div>
  </div>
  <?php 
         $labb--;
        
        ?>
  <?php endforeach ?>

  </div> 
  </div>  

  <?php $tutt = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->count(); ?>
<!-- ########################################### tutorial work ######################################## -->
     <div class="tab-pane fade" id="tutorials" role="tabpanel" aria-labelledby="custom-tabs-tutorials">
   <div class="accordion" id="accordionExample_4">
                 
              
             
   <?php foreach( $tutorials as $tutorial ) : ?>
  <div class="card">
    <div class="card-header p-2" id="heading<?=$tutt?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$tutt?>" aria-expanded="true" aria-controls="collapse<?=$tutt?>">
        <i class="fas fa-clipboard-list"></i> <?php echo "Tutorial ".$tutt;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$tutt?>" class="collapse" aria-labelledby="heading<?=$tutt?>" data-parent="#accordionExample_4">
      <div class="card-body">
      <p><span style="color:green"> About: </span> <?= $tutorial -> assName ?></p>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
     
      </div>
      <div class="col-md-6">
              <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> $tutorial->assID])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>
                      
              <a href="<?= Url::toRoute(['/student/view_assignment','assID'=> $tutorial->assID])?>" class="btn btn-sm btn-info float-right"><span><i class="fas fa-eye"> View</i></span></a>
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php 
         $tutt--;
        
        ?>
  <?php endforeach ?>


</div>

</div>
 

<!-- ########################################### materials ######################################## -->      
<?php $mat = Material::find()->where(['course_code' => $cid])->count(); ?>

<?php $videos = Material::find()->where('course_code = :course_code AND material_type = :material_type', [ ':course_code'=> $cid, ':material_type' => 'Videos'])->count(); ?>

<?php $notesAndBooks = Material::find()->where('course_code = :course_code AND material_type = :material_type', [ ':course_code'=> $cid, ':material_type' => "Notes"])->count(); ?>

<div class="tab-pane fade" id="coursematerials" role="tabpanel" aria-labelledby="custom-tabs-coursematerials">
<div class="accordion" id="accordionExample_3">

<div class="row">
            <div class="col-lg-3 col-6">
                <a href="<?=Url::to(['student/classwork/'])  ?>" class="small-box bg-info" >
                
                    <div class="inner">
                      <h3><?= $cid ?></h3>

                      <p >videos <?= $videos ?></p>
                    </div>

                    <div class="icon">
                      <i class="fa fa-play"></i>
                    </div>

                  </a>
            </div> 

            <div class="col-lg-3 col-6">
                <a href="<?=Url::to(['student/classwork/'])  ?>" class="small-box bg-info" >
                
                    <div class="inner">
                      <h3><?= $cid ?></h3>

                      <p > Notes & Books <?= $notesAndBooks ?></p>
                    </div>

                    <div class="icon">
                      <i class="fa fa-tags"></i>
                    </div>

                  </a>
             </div> 
    </div>
    

</div>

</div>
<!-- ########################################### returned marks ######################################## -->

<div class="tab-pane fade" id="returned" role="tabpanel" aria-labelledby="custom-tabs-returned">

<div class="accordion" id="accordionExample_3">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title com-sm-12 text-secondary">
                <i class="fas fa-book mr-1"></i>
                My results  
                </h3>
              </div>
              <div class="card-body">
 
             <div class="row">
              <!-- <?= VarDumper::dump($returned) ?> -->
               <div class="col-md-12">
                  <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                  <thead>
                  <tr>
                  <th width="1%">#</th><th>Assignment Name</th><th>Assinment Type</th><th>filename</th><th>Score/Total</th><th>comment</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=0; ?>
                  <?php foreach($returned as $returne): ?>
                    <?php foreach($returne->submits as $submit_returne): ?>
                      <tr>
                      <td><?= ++$i; ?></td>
                      <td><?= $returne->assName ?> </td>
                      <td><?= $returne->assType ?> </td>
                      <td><?= $submit_returne->fileName;  ?></td>
                      <td><?= $submit_returne->score.'/'.$returne->total_marks  ?></td>
                      <td><?= $submit_returne->comment;  ?></td>
                      </tr>
                    <?php endforeach ?>
                  <?php endforeach ?>
                  </tbody>
                  </table>
                 </div>
               </div>
              </div>
            </div>
      </section>
</div>

  </div>
  <!-- ########################################### announcements ######################################## --> 
     <div class="tab-pane fade" id="announcements" role="tabpanel" aria-labelledby="custom-tabs-Announcements">
          <div class="row">
            <p>ANOUNCEMENTS TUTAZIVUTA HAPA</p>
                  
        </div>

   <div class="accordion" id="accordionExample_4"></div>
   </div>
   <!-- ########################################### quiz######################################## --> 
   <div class="tab-pane fade" id="quiz" role="tabpanel" aria-labelledby="custom-tabs-quiz">
          <div class="row">
            <p>QUIZ TUTAZIVUTA HAPA</p>
                  
        </div>

   <div class="accordion" id="accordionExample_4">
   
  

</div>



     <!-- ########################################### end ################################# -->
    </div>
    </div>
</div>

</section>
          
</div>

      </div><!--/. container-fluid -->

    </div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
  });
//Remember active tab
$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

localStorage.setItem('activeTab', $(e.target).attr('href'));

});

var activeTab = localStorage.getItem('activeTab');

if(activeTab){

$('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');

}
  
});
JS;
$this->registerJs($script);
?>
