<?php

use common\models\Instructor;
use common\models\Material;
use common\models\Module;
use frontend\models\ClassRoomSecurity;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Assignment;
use common\models\Submit;

/* @var $this yii\web\View */
$this->params['courseTitle'] = yii::$app->session->get('ccode')." Online Lectures";
$this->title = yii::$app->session->get('ccode')."Online Lectures";
$this->params['breadcrumbs'] = [
    ['label'=>'Class Dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get('ccode'))])],
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
                    <div class="card">
                        <div class="card-body" >

                                <!-- ########################################### Course materials ######################################## -->
                                <?php for($i=0;$i<count($lectures) ;$i++) { ?>
                                <div class="accordion" id="accordionExample_3">
                                    
                                

                                            <div class="card shadow-lg">
                                                <div class="card-header p-2" id="heading<?=$i?>">
                                                
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
                                                                    <h5><img src="<?= Yii::getAlias('@web/img/onlinelectures.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header"><?php echo $lectures[$i]->getMeetingName();?></span></h5>
                                                                    <div class="row">
                                                                        <div class="col-sm-12"><?=$lectures[$i]->getDescription();?></div>
                                                                        
                                                                    </div>
                               
                                                                   <div class="row mt-3">
                                                                   <div class="col-sm-12">
                                                                            <span>Type:</span>
                                                                            <?php
                                                                             if($lectures[$i]->isRecording()){print("Recording");}
                                                                             else{print("RealTime");}
                                                                            ?>




                                                                        </div>

                                                                   </div>
                                                               
                                                                </button>
                                                            </div>

                                                            <div class="col-sm-5 pt-4">
            
                                                         
                                                
                                                                <div class="row ">
                                                                
                                                            <div class="col-sm-8 d-flex justify-content-center text-center">
                                                            <a class="shadow p-3" href="<?=Url::to(['student-lectureroom/join-lecture','session'=>$lectures[$i]->getMeetingId(),'student'=>$lectures[$i]->getAttendeePassword()]) ?>">
                                                            <i class="fa fa-play-circle " style="font-size:40px;color:rgba(70,100,255,.6)"></i><br>Join Lecture</a>
                                                        
                                                            </div>
                                                            <div class="col-sm-4 mt-4 pt-1 float-left">
                                                            <?php
                                                            if($lectures[$i]->hasBeenForciblyEnded())
                                                            {
                                                                print("Ended");

                                                            }
                                                            else if($lectures[$i]->isRunning())
                                                            {
                                                                ?>
                                                                <div class="spinner-grow spinner-grow-sm text-dark pt-2 float-left"></div>
                                                                <?php
                                                                print("Ongoing...");
                                                            }
                                                            else
                                                            {
                                                                print("Awaiting...");
                                                            }
                                                            ?>
                                                            </div>
                                                           
                                                            </div>
                                                        </div></div>
                                                        <div class="row pl-2 pt-1 mt-5 d-flex justify-content-center">
                                                                        <div class="col-sm"><i class="fas fa-calendar-check"></i><br><?=date('m/d/Y H:i:s',$lectures[$i]->getStartTime());?></div>
                                                                        <div class="col-sm"><i class="fas fa-clock"></i><br><?=$lectures[$i]->getDuration();?></div>
                                                                        <div class="col-sm"> <i class="fas fa-user-friends"></i><br>	<?=$lectures[$i]->getParticipantCount();?></div>
                                                                       
                
                                                                    </div>
                                                   
                                                </div>

                                                <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordionExample_3">

                                                  
                                              
                                                  
                                                    <div class="card-body material-background">
                                                    <?php
                                                      //if(empty($lectures[$i]->recordings())){print("No any recordings found");}
                                                      print_r($lectures[$i]->recordings());
                                    
                                                    ?>

                                                                <!-- ########################################### Course materials end ######################################## -->
                                                    </div>
                                    </div>
                                    </div>
                        
                        <?php }?>
                    </div>
                                    </div>
                                    </div>
                </section>
            </div>
        </div><!--/. container-fluid -->
    </div>
</div>

