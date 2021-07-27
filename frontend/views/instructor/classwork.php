<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\StudentCourse;
use common\models\Submit;
use common\models\Material;
use common\models\ExtAssess;
use common\models\ProgramCourse;
use common\models\Announcement;
use frontend\models\UploadAssignment;
use frontend\models\CA;
use frontend\models\UploadTutorial;
use frontend\models\PostAnnouncement;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\StudentGroups;
use frontend\models\External_assess;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$this->params['courseTitle'] = "Course ".$cid;
$this->title = 'Classwork';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/instructor/classwork', 'cid'=>$cid])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid >
      
 <div class="row ">
          <!-- Left col -->
          <section class="col-lg-12 ">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-forum" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="true">Announcements</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-materials" data-toggle="tab" href="#materials" role="tab" aria-controls="materials" aria-selected="false">Materials</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-assignments" data-toggle="tab" href="#assignments" role="tab" aria-controls="assignment" aria-selected="false">Assignments</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-lab" data-toggle="tab" href="#labs" role="tab" aria-controls="labs" aria-selected="false">Labs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-tutorials" data-toggle="tab" href="#tutorials" role="tab" aria-controls="tutorials" aria-selected="false">Tutorials</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-external-assessment" data-toggle="tab" href="#externals" role="tab" aria-controls="externals" aria-selected="false">External assessments</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-ca" data-toggle="tab" href="#ca" role="tab" aria-controls="ca" aria-selected="false">CA generator</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-ca" data-toggle="tab" href="#students" role="tab" aria-controls="students" aria-selected="false">Students</a>
                    </li>
              
                </ul>
              
              </div>
             
              <div class="card-body" >
             
                <div class="tab-content" id="custom-tabs-four-tabContent">

<!-- ########################################### Announcements ######################################## --> 
                  <div class="tab-pane fade show active" id="forum" role="tabpanel" aria-labelledby="custom-tabs-forum">
                  <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#announce" data-toggle="modal" style="margin-left:5px"><i class="fas fa-plus"  ></i>New annoucement</a>
            </div>    
          </div>
   
   <div class="container-fluid">
   <?php
  
   $announcements=Announcement::find()->where(['course_code'=>$cid])->all();
   foreach($announcements as $announcement)
   {
     ?>
  
    <div class="card shadow" >
    <div class="card-header p-2" id="heading">
    <div class="row">
    <div class="col-md-10">
    <i class="fa fa-bullhorn"></i><span style="font-size:12px;margin-left:20px;color:#bbb">by <?=$announcement->instructor->full_name;?></span>
   </div>
   <div class="col-md-2">
  <?= Html::a('<i class="fa fa-trash float-right"></i>', ['delete-announcement','annid'=>$announcement->annID]) ?>
   </div>
   </div>
    </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?= $announcement->content ?>
   </div>
   </div>
  
  </div>
   <div class="card-footer text-center" style="font-size:12px">
  <i class="fas fa-clock" ></i><?=$announcement->ann_date." ".$announcement->ann_time?>
  
   </div>



     </div>
    
 

   <?php 
   }
   ?>
      </div>
                  </div>
<!-- ########################################### material work ######################################## --> 

<?php $mat = Material::find()->where(['course_code' => $cid])->count(); ?>

<!-- ########################################### material work ######################################## -->      

<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="custom-tabs-material">

      <div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createMaterialModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample_6">

<?php foreach( $materials as $material ) : ?>

  <div class="card" >
    <div class="card-header p-2" id="heading<?=$mat?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$mat?>" aria-expanded="true" aria-controls="collapse<?=$mat?>">
      <?php if(in_array(pathinfo($material->fileName,PATHINFO_EXTENSION),['MP4','mp4']))
          {
      ?>
      <img src="/img/video thumb.png" style="width:4%;height:20px;margin-right:3px"/><?= $material -> title ?>
       <?php 
          }
          else if(in_array(pathinfo($material->fileName,PATHINFO_EXTENSION),['pdf','PDF']))
          {
       ?>
      <i class="fa fa-file-pdf-o" style="font-size:20px;color:red;margin-right:3px"></i><?= $material -> title ?>
      <?php
          }
          else
          {
      ?>
      <i class="fa fa-files-o" style="font-size:25px;margin-right:4px"></i><?= $material -> title ?>
      <?php
          }
      ?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$mat?>" class="collapse" aria-labelledby="heading<?=$mat?>" data-parent="#accordionExample_6">
      <div class="card-body">
         <p><span style="color:red"> Material Title: </span> <b> <?= $material -> title ?> </b></p>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
       <?php if(in_array(pathinfo($material->fileName,PATHINFO_EXTENSION),['MP4','mp4']))
       {
         ?>
      <a href="<?=Url::to(['material/player','currentvid'=>$material->fileName,'currenttitle'=>$material->title])?>"  class="text-mutted">Material <i class="fas fa-eye"></i></a>
      <?php
       }
      else{

      ?>
      <a href="/storage/temp/<?=$material->fileName ?>"  class="text-mutted">Material <i class="fas fa-eye"></i></a>
      <?php
      }
      ?>
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-danger float-right ml-2"><span><i class="fas fa-trash"></i></span></a>
      <a href="/storage/temp/<?=$material->fileName ?>" class="btn btn-sm btn-success float-right" download><span><i class="fas fa-download"></i></span></a>
     
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $mat--;
        
        ?>
  
  <?php endforeach ?>


</div>

</div>


<!-- ########################################### assignment work ######################################## -->

<?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->count(); ?>      

<div class="tab-pane fade" id="assignments" role="tabpanel" aria-labelledby="custom-tabs-assignment">

      <div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createAssignmentModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i> Create New</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample">
<?php $assk = "Assignment".$ass ;
$assk = "Assignment".$ass;
?>
<?php foreach( $assignments as $assign ) : ?>

  <div class="card headcard">
    <div class="card-header p-2 shadow" id="heading<?=$ass?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$ass?>" aria-expanded="true" aria-controls="collapse<?=$ass?>">
        <i class="fas fa-clipboard-list"></i> <?php echo $assign->assName;?>
        </button>
      </div>
      <div class="col-sm-1" data-toggle="collapse" data-target="#collapse<?=$ass?>" aria-expanded="true" aria-controls="collapse<?=$ass?>">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
         
       
      </h2>
    </div>

    <div id="collapse<?=$ass?>" class="collapse shadow" aria-labelledby="heading<?=$ass?>" data-parent="#accordionExample">
      <div class="card-body ">
        <div class="row">
        
      <div class="col-md-3 col-sm-6 col-12">
      <?php 
      $submits=[];
      $assigned=0;
      if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
      else if($assign->assType=="allgroups"){
        $submits=$assign->groupAssignmentSubmits;
        $gentypes=$assign->groupGenerationAssignments;
        for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
      }
      else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
      else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);}
      $subperc=0;
      if($assigned!=0)
      {
      $subperc=(count($submits)/$assigned)*100;
      }
      ?>
      <a href="<?=Url::to(['instructor/stdwork/', 'cid'=>$assign->course_code, 'id' => $assign->assID]) ?>" >
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Submitted</span>
                <span class="info-box-number"><?=floor($subperc)?>%</span>
              </div>
        
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
          <?php 
            $submits=[];
            $assigned=0;
            if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
            else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);} 
            
            $missing=$assigned-count($submits);
            $missperc=0;
            if($assigned!=0)
            {
            $missperc=($missing/$assigned)*100;
            }
            
            ?>
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Missing</span>
                <span class="info-box-number"><?=floor($missperc)?>%</span>
              </div>
     
            </div>
    
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=Url::to(['instructor/stdworkmark/', 'cid'=>$assign->course_code, 'id' => $assign->assID]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <?php 
            $submits=[];
            $assigned=0;
            $marked_submits=[];
            if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
            else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);} 
            
            for($o=0;$o<count($submits);$o++)
            {
              if($submits[$o]->isMarked()){array_push($marked_submits,$submits[$o]);}
            }
            $marked=count($marked_submits);
            $allsubmits=count($submits);
            $markperc=0;
            if($allsubmits!=0)
            {
            $markperc=($marked/$allsubmits)*100;
            }
            ?>
                <span class="info-box-text">Marked</span>
                <span class="info-box-number"><?=floor($markperc)?>%</span>
              </div>
      
            </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
              <div class="info-box-content">
              <?php 
            $submits=[];
            $failed_submits=[];
            $marked_submits=[];
            if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
            else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);} 
            
            for($o=0;$o<count($submits);$o++)
            {
              if($submits[$o]->isMarked()){array_push($marked_submits,$submits[$o]);}
            }
            for($f=0;$f<count($submits);$f++)
            {
              if($submits[$f]->isFailed()){array_push($failed_submits,$submits[$f]);}
            }
            $marked=count($marked_submits);
            $failedsubmits=count($failed_submits);
            $failedperc=0;
            if($marked!=0)
            {
            $failedperc=($failedsubmits/$marked)*100;
            }
            ?>

                <span class="info-box-text">Failed</span>
                <span class="info-box-number"><?=floor($failedperc)?>%</span>
              </div>
            </div>
          </div>
</div>
          <!--################################################################################################################ -->
        
      </div>

      <div class="card-footer p-2 bg-white border-top ">
      <div class="row">
      <div class="col-md-9" style="font-size:12px;">
      <i class="fas fa-clock" aria-hidden="true"></i> <b>Deadline : </b> <?= $assign -> finishDate ?>
      </div>
      <div class="col-md-3">
        
      <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger<?= $assign -> assID ?>"><span><i class="fas fa-trash"></i></span></a>
      <?= Html::a('<i class="fas fa-edit"></i>',['update', 'id'=>$assign->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      <a href="/storage/temp/<?= $assign -> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      <?= Html::a('<i class="fa fa-pen"></i>',['mark', 'id'=>$assign->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      </div>
      </div>
      </div>
    </div>
  </div>

  <?php 
         $ass--;
        
        ?>
        
<div class="modal fade" id="modal-danger<?= $assign -> assID ?>">

        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Deleting <b> <?= $assign -> assName ?> </b> Assignment</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
            
              <p>Are you sure, you want to delete <b> <?= $assign -> assName ?> </b> assignment&hellip;?</p>
              
            </div>
            <div class="modal-footer justify-content-between">
            
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <?= Html::a('Delete', ['delete', 'cid'=>$assign->course_code, 'id'=>$assign -> assID], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        
      </div>
      <!-- /.modal -->
  
  <?php endforeach ?>


</div>

</div>


<?php $labb = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->count(); ?>
<!-- ########################################### lab work ######################################## -->

<div class="tab-pane fade" id="labs" role="tabpanel" aria-labelledby="custom-tabs-lab">
<div class="row">
        <div class="col-md-12">
              <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createLabModal" data-toggle="modal"><i class="fas fa-plus" data-toggle="modal" ></i>Create</a>
        </div>
                  
      </div>

<div class="accordion" id="accordionExample_3">
<?php foreach( $labs as $assign ) : ?>
  <div class="card headcard">
    <div class="card-header p-2 shadow" id="heading<?=$labb?>">
      <h2 class="mb-0">
      <div class="row">
      <div class="col-sm-11">
      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$labb?>" aria-expanded="true" aria-controls="collapse<?=$labb?>">
        <i class="fas fa-clipboard-list"></i> <?php echo $assign->assName;?>
        </button>
      </div>
      <div class="col-sm-1">
      <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
      </div>
      </div>
        
       
      </h2>
    </div>

    <div id="collapse<?=$labb?>" class="collapse shadow" aria-labelledby="heading<?=$labb?>" data-parent="#accordionExample_3">
      <div class="card-body">
      <div class="row">
        
      <div class="col-md-3 col-sm-6 col-12">
      <?php 
      $submits=[];
      $assigned=0;
      if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
      else if($assign->assType=="allgroups"){
        $submits=$assign->groupAssignmentSubmits;
        $gentypes=$assign->groupGenerationAssignments;
        for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
      }
      else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
      else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);}
      $subperc=0;
      if($assigned!=0)
      {
      $subperc=(count($submits)/$assigned)*100;
      }
      ?>
      <a href="<?=Url::to(['instructor/stdwork/', 'cid'=>$assign->course_code, 'id' => $assign->assID]) ?>" >
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Submitted</span>
                <span class="info-box-number"><?=floor($subperc)?>%</span>
              </div>
        
            </div>
            </a>
          </div>

          <div class="col-md-3 col-sm-6 col-12">
          <?php 
            $submits=[];
            $assigned=0;
            if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){
                $assigned=$assigned+count($gentypes[$gen]->gentype->groups);
              }

    
            }
            else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
            else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);} 
            $missing=$assigned-count($submits);
            $missperc=0;
            if($assigned!=0)
            {
            $missperc=($missing/$assigned)*100;
            }
            
            ?>
            <div class="info-box shadow">
              <div class="info-box-content">
                <span class="info-box-text">Missing</span>
                <span class="info-box-number"><?=$missperc?>%</span>
              </div>
     
            </div>
    
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=Url::to(['instructor/stdworkmark/', 'cid'=>$assign->course_code, 'id' => $assign->assID]) ?>">
            <div class="info-box shadow">
              <div class="info-box-content">
                <?php 
            $submits=[];
            $assigned=0;
            $marked_submits=[];
            if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
            else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);} 
            
            for($o=0;$o<count($submits);$o++)
            {
              if($submits[$o]->isMarked()){array_push($marked_submits,$submits[$o]);}
            }
            $marked=count($marked_submits);
            $allsubmits=count($submits);
            $markperc=0;
            if($allsubmits!=0)
            {
            $markperc=($marked/$allsubmits)*100;
            }
            ?>
                <span class="info-box-text">Marked</span>
                <span class="info-box-number"><?=floor($markperc)?>%</span>
              </div>
      
            </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow">
              <div class="info-box-content">
              <?php 
            $submits=[];
            $failed_submits=[];
            $marked_submits=[];
            if($assign->assType=="groups"){$submits=$assign->groupAssignmentSubmits;$assigned=count($assign->groupAssignments);}
            else if($assign->assType=="allgroups"){
              $submits=$assign->groupAssignmentSubmits;
              $gentypes=$assign->groupGenerationAssignments;
              for($gen=0;$gen<count($gentypes);$gen++){$assigned=$assigned+count($gentypes[$gen]->gentype->groups);}
            }
            else if($assign->assType=="allstudents"){$submits=$assign->submits;$assigned=count($assign->courseCode->studentCourses);}
            else{$submits=$assign->submits;$assigned=count($assign->studentAssignments);} 
            
            for($o=0;$o<count($submits);$o++)
            {
              if($submits[$o]->isMarked()){array_push($marked_submits,$submits[$o]);}
            }
            for($f=0;$f<count($submits);$f++)
            {
              if($submits[$f]->isFailed()){array_push($failed_submits,$submits[$f]);}
            }
            $marked=count($marked_submits);
            $failedsubmits=count($failed_submits);
            $failedperc=0;
            if($marked!=0)
            {
            $failedperc=($failedsubmits/$marked)*100;
            }
            ?>

                <span class="info-box-text">Failed</span>
                <span class="info-box-number"><?=floor($failedperc)?>%</span>
              </div>
            </div>
          </div>
  </div>
      </div>
      
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-9" style="font-size:12px;">
      <i class="fas fa-clock" aria-hidden="true"></i> <b>Deadline : </b> <?= $assign -> finishDate ?>
      </div>
      <div class="col-md-3">
        
      <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger<?=$assign -> assID ?>"><span><i class="fas fa-trash"></i></span></a>
      <?= Html::a('<i class="fas fa-edit"></i>',['updatelab', 'id'=>$assign->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      <a href="/storage/temp/<?=$assign-> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      <?= Html::a('<i class="fa fa-pen"></i>',['mark', 'id'=>$assign->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php 
         $labb--;
        
        ?>
  <div class="modal fade" id="modal-danger<?=$assign-> assID ?>">

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Deleting <b> <?= $assign -> assName ?> </b> Lab</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <div class="modal-body">
    
      <p>Are you sure, you want to delete <b> <?= $assign -> assName ?> </b> lab&hellip;?</p>
      
    </div>
    <div class="modal-footer justify-content-between">
    
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      <?= Html::a('Delete', ['deletelab', 'cid'=>$assign->course_code, 'id'=>$assign-> assID], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
    </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->



</div>
  <?php endforeach ?>


</div>

  </div>
    
       
  <?php $tutt = Assignment::find()->where(['assNature' => 'tutorial', 'course_code' => $cid])->count(); ?>
<!-- ########################################### tutorial work ######################################## -->
     <div class="tab-pane fade" id="tutorials" role="tabpanel" aria-labelledby="custom-tabs-tutorials">
          <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createTutorialModal" data-toggle="modal"><i class="fas fa-plus"  ></i> Create</a>
            </div>
                  
        </div>

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
     <center> <p><span style="color:red"> Tutorial Title: </span> <b> <?= $tutorial -> assName ?> </b></p></center>
      </div>
      <div class="card-footer p-2 bg-white border-top">
      <div class="row">
      <div class="col-md-6">
      
      </div>
      <div class="col-md-6">
      <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger<?= $tutorial -> assID ?>"><span><i class="fas fa-trash"></i></span></a>
      <?= Html::a('<i class="fas fa-edit"></i>',['updatetut', 'id'=>$tutorial->assID], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
      <a href="/storage/temp/<?= $tutorial -> fileName ?>" download target="_blank" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-download"></i></span></a>
      
     
      </div>
      </div>
      </div>
    </div>
  </div>
  <?php 
         $tutt--;
        
        ?>

<div class="modal fade" id="modal-danger<?= $tutorial -> assID ?>">

<div class="modal-dialog">
  <div class="modal-content bg-danger">
    <div class="modal-header">
      <h4 class="modal-title">Deleting <b> <?= $tutorial -> assName ?> </b> Tutorial</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <div class="modal-body">
    
      <p>Are you sure, you want to delete <b> <?= $tutorial -> assName ?> </b> Tutorial&hellip;?</p>
      
    </div>
    <div class="modal-footer justify-content-between">
    
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      <?= Html::a('Delete', ['deletetut', 'cid'=>$tutorial->course_code, 'id'=>$tutorial -> assID], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
    </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
   </div>
  <?php endforeach ?>


</div>

</div>
<!--######################external assessment ##############-->
<div class="tab-pane fade" id="externals" role="tabpanel" aria-labelledby="custom-tabs-externals">
          <div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#external_assess" data-toggle="modal" style="margin-left:5px"><i class="fas fa-plus"  ></i>New assessment</a>
            
            <?= Html::a('<i class="fas fa-download" ></i>Download template', ['download-extassess-template','coursecode'=>$cid],['class'=>'btn btn-sm btn-primary btn-rounded float-right mb-2']) ?>
            </div>
         
                  
          </div>
   
   <div class="container-fluid">
   <?php
  
   $assessments =ExtAssess::find()->where(['course_code'=>$cid])->all();
   foreach($assessments as $assess)
   {
     ?>
  
    <div class="card" >
    <div class="card-header p-2" id="heading<?=$mat?>">
  <div class="row">
    <div class="col-md-10">
    <i class="fas fa-clipboard-list"></i><?= $assess->title ?>
   </div>
   <div class="col-md-2">
  <?= Html::a('<i class="fa fa-trash float-right"></i>', ['delete-assessment','assessid'=>$assess->assessID]) ?>
  <?= Html::a('<i class="fas fa-eye float-right" style="margin-right:5px"></i>', ['view-assessment','assid'=>$assess->assessID]) ?>
   </div>
   </div>
  
  </div>

   </div>
    
 

   <?php 
   }
   ?>
      </div>
   </div>
   <!--##################### the CA ######################## -->
  
   <div class="tab-pane fade" id="ca" role="tabpanel" aria-labelledby="custom-tabs-ca">
   <?php 
      $assignments=Assignment::find()->where(['course_code'=>$cid,'assNature'=>'assignment'])->all();
      $assArray=ArrayHelper::map($assignments,'assID','assName');
      $labs=Assignment::find()->where(['course_code'=>$cid,'assNature'=>'lab'])->all();
      $labarray=ArrayHelper::map($labs,'assID','assName');
      $others=ExtAssess::find()->where(['course_code'=>$cid])->all();
      $othersarray=ArrayHelper::map($others,'assessID','title');
      $camodel=new CA();
   ?>
   <div class="container-fluid">
    <div class="card shadow" >
    <div class="card-header p-2" id="heading">
    <div class="row">
    <div class="col-md-10">
    <span style="margin-left:20px;">Choose assessments to include in the CA</span>
   </div>
   </div>
    </div>
    <?php     
$form = ActiveForm::begin([
    'id' => 'login-form',
    'action'=>'/instructor/generate-ca',
    'method'=>'post',
    'options' => ['class' => 'form-horizontal']
]) ?>
    <div class="card-body">

  <div class="row">
    <div class="col-md-4">
      <!-- 
        ######################### the assignments
      -->

    <div class="card shadow" >
      <div class="card-header p-2 bg-primary text-sm">
        Assignments
      </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?= $form->field($camodel, 'Assignments[]')->checkboxList($assArray)->label(false) ?>
    <?= $form->field($camodel, 'otherassessreduce')->textInput(['type'=>'text','class'=>'form-control form-control-sm','placeholder'=>'Max','id'=>'other'])->label(false)?>
   </div>
   </div>
 
  
  </div>




     </div>

      <!--########################################-->
   </div>
   <div class="col-md-4">
      <!-- 
        ######################### the labs
      -->

    <div class="card shadow" >
    <div class="card-header p-2 bg-primary text-sm">
        Lab assignments
      </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?= $form->field($camodel, 'LabAssignments[]')->checkboxList($labarray)->label(false) ?>
    <?= $form->field($camodel, 'otherassessreduce')->textInput(['type'=>'text','class'=>'form-control form-control-sm','placeholder'=>'Max','id'=>'other'])->label(false)?>
   </div>
   </div>
  
  </div>




     </div>

      <!--########################################-->
   </div>
   <div class="col-md-4">
      <!-- 
        ######################### other assessments
      -->

    <div class="card shadow" >
    <div class="card-header p-2 bg-primary text-sm">
       Other assessments
      </div>
    <div class="card-body">
  <div class="row">
    <div class="col-md-12">
    <?php if(empty($othersarray)){print "<span class='info'>No assessment found</span>";} ?>
    <?= $form->field($camodel, 'otherAssessments[]')->checkboxList($othersarray)->label(false)?>
    <?= $form->field($camodel, 'otherassessreduce')->textInput(['type'=>'text','class'=>'form-control form-control-sm','placeholder'=>'Max','id'=>'other'])->label(false)?>
   </div>
   </div>

  </div>




     </div>

      <!--########################################-->
   </div>
   </div>
  
 
  <!-- the stats-->
  <div class="row">
  <div class="col-md-4">
  <div class="info-box shadow">
  <div class="info-box-content">
    <span class="info-box-text text-primary">Carries</span>
    <span class="info-box-number" id="carries"></span>
  </div>
     
  </div>
   </div>
   <div class="col-md-4">
   <div class="info-box shadow">
    <div class="info-box-content">
      <span class="info-box-text text-primary">Incomplete</span>
      <span class="info-box-number" id="incomplete"></span>
    </div>
     
    </div>
</div>
   <div class="col-md-4">

   <div class="info-box shadow">
    <div class="info-box-content">
      <span class="info-box-text text-primary" id="pass">Pass</span>
      <span class="info-box-number"></span>
    </div>
     
    </div>
</div>
  </div> 
  </div>
   <div class="card-footer text-center" style="font-size:12px">
   <?= Html::submitButton('Download as Excel', ['class'=>'btn btn-primary btn-rounded btn-sm']) ?>
  <?= Html::a('<button class="btn btn-primary btn-rounded btn-sm" style="margin-right:5px">Preview</button>', ['view-assessment']) ?>
  
   </div>


   <?php ActiveForm::end() ?>
     </div>
      </div>
  </div>

     <!-- ########################################### end CA ################################# -->
     <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="custom-tabs-Students">
     <?php 
     $students=[];

     $coursePrograms=ProgramCourse::find()->where(['course_code'=>$cid])->all();
     foreach($coursePrograms as $program)
     {

      $programStudents=$program->programCode0->students;

      for($s=0;$s<count($programStudents);$s++){array_push($students,$programStudents[$s]);}


     }
     $carryovers=StudentCourse::find()->where(['course_code'=>$cid])->all(); 

     foreach($carryovers as $carry)
     {
      array_push($students,$carry->regNo);
     }
     
     shuffle($students);
     if($students!=null){
       
       
       ?>
          <div class="row">
          <div class="col-md-12">
          <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createTutorialModal" data-toggle="modal" style="margin-left:10px"><i class="fas fa-plus" ></i>Assign Students</a>
          <a href="/instructor/view-groups" class="btn btn-sm btn-primary btn-rounded float-right mb-2"><i class="fas fa-group" ></i>Student Groups</a>
            
            </div>
            </div>
            <table width="100%" class="table table-striped table-bordered table-hover" id="studenttable" style="font-size:12px">
		<thead>
			<tr>
				<th>
					Reg #
				</th>

				<th>
				Degree program
				</th>
       <th>
       Full name
				</th>
				<th>
					Gender
				</th>
				<th>
				YOS
				</th>
				<!-- <th>
					Question
				</th> -->
				
				<th>
					Action
				</th>
				<!-- <th>
					Grading
				</th> -->
				
			</tr>
		</thead>
		<tbody>
								<?php for($l=0;$l<count($students);$l++){ $student=$students[$l];?>
						 			<tr>
									 	<td><?=  $student->reg_no; ?></td>
                    <td><?=  $student->programCode; ?></td>
                    <td><?=  $student->fname." ".$student->mname." ".$student->lname; ?></td>
                    <td><?=  $student->gender; ?></td>
                    <td><?=  $student->YOS; ?></td>
                    <td><i class="fa fa-edit" style="font-size:18px"></i></td>
							
									
										
										


						 			</tr>
						 		
									 <?php }?>
		
			

		</tbody>
		</table>
    <?php
             }
             else
             {
               ?>
                <div class="container-fluid p-3 my-3 border text-info jumbotron text-center"><h5>This course has no students</h5></div>
               <?php
             }
    ?>
    </div>
    </div>
</div>

</section>
          
</div>

      </div><!--/. container-fluid -->

    </div>
</div>
<!--  ###################################render model to create_assignment ###########################################-->
<?php 
$assmodel = new UploadAssignment();
?>
<?= $this->render('assignments/create_assignment', ['assmodel'=>$assmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to Create_tutorial ##############################################-->
<?php 
$tutmodel = new UploadTutorial();
?>
<?= $this->render('tutorials/create_tutorial', ['tutmodel'=>$tutmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to Create_lab ####################################################-->
<?php 
$labmodel = new UploadLab();
?>
<?= $this->render('labs/create_lab', ['labmodel'=>$labmodel, 'ccode'=>$cid]) ?>

<!--  ###################################render model to create_material ####################################################-->
<?php 
$assmodel = new UploadMaterial();
?>
<?= $this->render('materials/create_material', ['assmodel'=>$assmodel, 'ccode'=>$cid]) ?>
<!--  ###################################new assessment modal ####################################################-->
<?php 
$assessmodel = new External_assess();
?>
<?= $this->render('assessupload', ['assessmodel'=>$assessmodel, 'ccode'=>$cid]) ?>
<!--  ###################################new announce modal ####################################################-->
<?php 
$announcemodel = new PostAnnouncement();
?>
<?= $this->render('announcementForm', ['announcemodel'=>$announcemodel]) ?>



<?php 
$script = <<<JS
$(document).ready(function(){
  $(".headcard").on('show.bs.collapse','.collapse', function(e) {
  $(e.target).parent().addClass('shadow');
  });
  $(".headcard").on('hidden.bs.collapse','.collapse', function(e) {
  $(e.target).parent().removeClass('shadow');
  });
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  $("#studenttable").DataTable({
    responsive:true,
  });
  
  $(document).on('click', '.enroll', function(){
      $('.course-description').text($(this).attr('ccode')+'=>'+$(this).attr('cname'));
      $("#ccode").val($(this).attr('ccode'));
    })
    //sweetalert start here
    $(document).on('click', '.drop', function(){
      var ccode = $(this).attr('ccode');
 

      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
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

})

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
