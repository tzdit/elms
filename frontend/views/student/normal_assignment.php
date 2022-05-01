<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Assignment;
use common\models\Student;
use common\models\Submit;
use common\models\StudentGroup;
use frontend\models\ClassRoomSecurity;
use frontend\models\GroupAssSubmit;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;


/* @var $this yii\web\View */
$this->params['courseTitle'] ='<img src="/img/Assignment4.png" height="30px" width="29px"/> '.$cid. ' Individual Assignments';
$this->title ='Individual Assignments';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
    ['label'=>$this->title]
];

?>

<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"  ><a class="nav-link active" href="#tab_1" data-toggle="tab"> Normal Assignments </a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Lab Assignments </a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                  <div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">

            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">


                    <div class=" card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### Assignments ######################################## -->
                                <?php $ass = Assignment::find()->where(['assNature' => 'assignment', 'course_code' => $cid])->count(); ?>

                                    <div class="accordion" id="accordionExample">
                                        <?php $assk = "Assignment".$ass ;
                                        $assk = "Assignment".$ass;
                                        ?>
                                        <?php
                                        if(empty($assignments)){
                                            echo "<p class='text-muted text-lg'>";
                                            echo "No assignment found";
                                            echo "</p>";
                                        }
                                        ?>

                                        <?php foreach( $assignments as $assign ) : ?>

                                          
                                                <div class="card shadow-lg">
                                                    <div class="card-header p-2" id="heading<?=$ass?>">
                                                        <h2 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-sm-11">
                                                                    <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$ass?>" aria-expanded="true" aria-controls="collapse<?=$ass?>">
                                                                        <h5><img src="<?=  Yii::getAlias('@web/img/homework.png')?>" height="30px" width="30px"/><span class="assignment-auto"></span> <span class="assignment-header"><?php  echo ucwords($assign -> assName)?></span></h5>
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
                                                            <p><span style="color:green"> Description: </span>  <?= $assign -> ass_desc ?> </p>
                                                        </div>
                                                        <div class="card-footer p-2 bg-white border-top">
                                                            <div class="row">
                                                                <div class="col-md-6">

                                                                    <?php
                                                                    //variable to check if there is any submission
                                                                    $submited = Submit::find()->where('reg_no = :reg_no AND assID = :assID', [ ':reg_no' => $reg_no,':assID' => $assign->assID])->one();
                                                                    ?>

                                                                    <?php
                                                                    date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                    // check if deadline of submit assignment is met
                                                                    $currentDateTime = new DateTime("now");
                                                                    //set an date and time to work with
                                                                    $start = $assign->finishDate;
                                                    
                                                                    $deadLineDate = new DateTime($start);
                                                                    $isOutOfDeadline =   $currentDateTime > $deadLineDate;
                                                                    ?>

                                                                    <b class="text-danger ml-3"><i class="fa fa-clock-o"></i> Deadline : </b><?= $deadLineDate->format('d-m-Y H:i:s A') ?> 
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($assign->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>


                                                                 
                                                                    <?php if($isOutOfDeadline == true){?>
                                                                                          <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                                      <?php }else{?>
                                                                                        <?php if($submited==null){?>
                                                                                          <a href="<?= Url::toRoute(['/student/submit_assignment','assID'=> ClassRoomSecurity::encrypt($assign->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                      <?php }else{ ?>
  
                                                                                        <?php if($assign->submitMode == "unresubmit"){?>
                                                                                        <button class="btn btn-sm btn-default float-right text-danger ml-2"><i class="fa  fa-ban"> Already Submitted</i></button>
                                                                                              <?php }else{ ?>
                                                                    
                                                                                          <a href="<?= Url::toRoute(['/student/resubmit','assID'=>  ClassRoomSecurity::encrypt($assign->assID), 'submit_id' => ClassRoomSecurity::encrypt($submited->submitID)])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                      <?php } ?>
                                                                                        <?php } ?>
                                                                                        <?php } ?>
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

                                <?php $labb = Assignment::find()->where(['assNature' => 'lab', 'course_code' => $cid])->count(); ?>
                                <!-- ########################################### Assignments end ######################################## -->

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div><!--/. container-fluid -->
    </div>
</div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      <div class="site-index">
                          <div class="body-content">
                              <!-- Content Wrapper. Contains page content -->

                              <div class="container-fluid">

                                  <div class="row">
                                      <!-- Left col -->
                                      <section class="col-lg-12">


                                          <div class=" card-outline card-outline-tabs">
                                              <div class="card-body" >
                                                  <div class="tab-content" id="custom-tabs-four-tabContent">

                                                      <?php
                                                      if(empty($labs)){
                                                          echo "<p class='text-muted text-lg'>";
                                                          echo "No lab found";
                                                          echo "</p>";
                                                      }
                                                      ?>

                                                      <!-- ########################################### lab work ######################################## -->
                                                      <?php $labb = Assignment::find()->where('assNature = :assNature AND course_code = :course_code',[':assNature' => 'lab', ':course_code' => $cid])->count(); ?>

                                                      <div class="accordion" id="accordionExample_3">
                                                          <?php foreach( $labs as $lab ) : ?>
                                                          
                                                                  <div class="card shadow-lg">
                                                                      <div class="card-header p-2" id="heading<?=$labb?>">
                                                                          <h2 class="mb-0">
                                                                              <div class="row">
                                                                                  <div class="col-sm-11">
                                                                                      <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$labb?>" aria-expanded="true" aria-controls="collapse<?=$labb?>">
                                                                                          <h5><img src="<?=  Yii::getAlias('@web/img/homework.png')?>" height="30px" width="30px"/> <span class="assignment-header"><?php echo "Lab ".$labb;?></span></h5>

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
                                                                              <p><span style="color:green"> Description: </span> <?= $lab -> assName ?></p>
                                                                          </div>
                                                                          <div class="card-footer p-2 bg-white border-top">
                                                                              <div class="row">
                                                                                  <div class="col-md-8 float-left">
                                                                                      <?php
                                                                                      date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                                      // check if deadline of submit assignment is met
                                                                                      $currentDateTime = new DateTime("now");
                                                                                      //set an date and time to work with
                                                                                      $start = $lab->finishDate;
                                                                      
                                                                                      $deadLineDate = new DateTime($start);
                                                                                      $isOutOfDeadline =   $currentDateTime > $deadLineDate;

                                                                                      ?>

                                                                                      <b class="text-danger ml-3"><i class="fa fa-clock-o"></i>Deadline : </b><?= $deadLineDate->format('d-m-Y H:i:s A') ?>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <?php
                                                                                      $submited = Submit::find()->where('reg_no = :reg_no AND assID = :assID', [ ':reg_no' => $reg_no,':assID' => $lab->assID])->one();
                                                                                      ?>

                                                                                      <a href="<?= Url::toRoute(['/student/download_assignment','assID'=> ClassRoomSecurity::encrypt($lab->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-download"> Download</i></span></a>

                                                                                      <?php if($isOutOfDeadline == true){?>
                                                                                          <a href="#" class="btn btn-sm btn-danger float-right ml-2"> Expired</i></span></a>
                                                                                      <?php }else{?>
                                                                                        <?php if($submited==null){?>
                                                                                          <a href="<?= Url::toRoute(['/student/submit_assignment','assID'=> ClassRoomSecurity::encrypt($lab->assID)])?>" class="btn btn-sm btn-info float-right ml-2"><span><i class="fas fa-upload"> Submit</i></span></a>
                                                                                      <?php }else{ ?>
  
                                                                                        <?php if($lab->submitMode == "unresubmit"){?>
                                                                                        <button class="btn btn-sm btn-default text-danger float-right ml-2" ><i class="fa fa-ban"> Already Submitted</i></button>
                                                                                              <?php }else{ ?>
                                                                    
                                                                                          <a href="<?= Url::toRoute(['/student/resubmit','assID'=>  ClassRoomSecurity::encrypt($lab->assID), 'submit_id' => ClassRoomSecurity::encrypt($submited->submitID)])?>" class="btn btn-sm btn-success float-right ml-2"><span><i class="fas fa-upload"> Resubmit</i></span></a>
                                                                                      <?php } ?>
                                                                                        <?php } ?>
                                                                                        <?php } ?>

                                                                                 
                                                                             


                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <?php
                                                                      $labb--;

                                                                      ?>
                                                                
                                                              </div>
                                                          <?php endforeach ?>

                                                      </div>
                                                      <!-- ########################################### lab work end ######################################## -->
                                                  </div>
                                              </div>
                                          </div>
                                      </section>
                                  </div>
                              </div><!--/. container-fluid -->
                          </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->


        </div>
    </div>


<?php 
$script = <<<JS

JS;
$this->registerJs($script);
?>


