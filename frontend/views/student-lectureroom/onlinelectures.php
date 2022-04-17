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
                                                    <h2 class="mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-11">
                                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?=$i?>" aria-expanded="true" aria-controls="collapse<?=$i?>">
                                                                    <h5><img src="<?= Yii::getAlias('@web/img/onlinelectures.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header"><?php echo $lectures[$i]->getMeetingName();?></span></h5>
                                                                    <div class="row">
                                                                        <div class="col-sm-2"><?=date('m/d/Y H:i:s',$lectures[$i]->getStartTime());?></div>
                                                                        <div class="col-sm-2"><?=$lectures[$i]->getDuration();?></div>
                                                                        <div class="col-sm-2"><?=$lectures[$i]->getParticipantCount();?></div>
                                                                        <div class="col-sm-2"><?=$lectures[$i]->getDuration();?></div>
                                                                    </div>
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                </div>

                                                <div id="collapse<?=$i?>" class="collapse" aria-labelledby="heading<?=$i?>" data-parent="#accordionExample_3">

                                                  
                                              
                                                  
                                                    <div class="card-body material-background">
                                                    <?php
                                                      print("recordings here");
                                    
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

