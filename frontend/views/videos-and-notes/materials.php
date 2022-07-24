<?php

use common\models\Instructor;
use common\models\Material;
use common\models\Module;
use frontend\models\ClassRoomSecurity;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Assignment;
use common\models\Submit;




//                            echo '<pre>';
//                            print_r($materials);
//                            echo  '</pre>';
////                            exit();


/* @var $this yii\web\View */
$this->params['courseTitle'] ='<img src="/img/module.png" width="25" height="25" > '.$cid.' Modules';
$this->title ='Modules';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
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
                            <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <?php $module_count = Module::find()->where('course_code = :course_code',[':course_code' => $cid])->count(); ?>
                                <?php
                                if(empty($materials)){
                                    echo "<p class='text-muted text-lg text-center p-1 responsivetext'>";
                                    echo "No material found";
                                    echo "</p>";
                                }
                                ?>

                                <!-- ########################################### Course materials ######################################## -->

                                <div class="accordion" id="accordionExample_3">
                                    <?php foreach( $materials as $material ) : ?>
                                  
                                            <div class="card shadow-lg">
                                                <div class="card-header p-2" id="heading<?=$module_count?>">
                                                    <h2 class="mb-0">
                                                        <div class="row">
                                                            <div class="col-sm-11">
                                                                <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$module_count?>" aria-expanded="true" aria-controls="collapse<?=$module_count?>">
                                                                    <h5 class="responsiveheader"><img src="<?= Yii::getAlias('@web/img/module.png') ?>" width="30" height="30" class="mt-1"> <span class="assignment-header responsiveheader"><?php echo $material['moduleName'];?></span></h5>
                                                                    <p class="responsiveheader"><span style="color:green"> About: </span> <?= $material['module_description'] ?></p>
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-1">
                                                                <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                </div>

                                                <div id="collapse<?=$module_count?>" class="collapse" aria-labelledby="heading<?=$module_count?>" data-parent="#accordionExample_3">

                                                    <?php
                                                    $videos_notes = Material::find()->where('moduleID = :moduleID ', [':moduleID' => $material['moduleID']])->orderBy(['material_id' => SORT_DESC])->asArray()->all();
                                                    $MaterialObject = new Material();
                                                    ?>

                                                    <?php
                                                    if(empty($videos_notes)){
                                                        echo "<p class='text-muted text-lg text-center mt-2 responsivetext'>";
                                                        echo "No material found";
                                                        echo "</p>";
                                                    }
                                                    ?>
                                                    <div class="card-body material-background">
                                                    <?php foreach ($videos_notes as $videos_note) : ?>
                                                    

                                                        <?php if($videos_note['material_type'] == 'Videos'):?>

                                                            
                                                                <div class="row  bg-white shadow-lg  p-2 m-2 ">

                                                                    <div class="col-md-5 float-left mb-2">

                                                                            <div class="row">
                                                                                <video  height="150" width="220" class=" m-0 p-0 col-sm-12">

                                                                                    <source  src="<?php echo $MaterialObject->getVideoAndNotesLink($videos_note['fileName']) ?>" type='video/mp4' size="576"/>
                                                                                    <source  src="<?php echo $MaterialObject->getVideoAndNotesLink($videos_note['fileName']) ?>" type='video/mp4' size="720"/>
                                                                                    <source  src="<?php echo $MaterialObject->getVideoAndNotesLink($videos_note['fileName']) ?>" type='video/mp4' size="1080"/>

                                                                                </video>
                                                                            </div>
                                                                            <!-- <?=
                                                                            var_dump($MaterialObject->getVideoAndNotesLink($videos_note['fileName']));

                                                                            ?> -->
                                                                    </div>
                                                                    <div class="col-md-4 m-0 mb-3 text-sm responsivetext">
                                                                        <h4 class="text-sm responsivetext m-0"><span style="color:green"> Name: </span> <?php echo $videos_note['title'] ?></h4>
                                                                             <?php
                                                                            $instractorName = Instructor::findOne($videos_note['instructorID']);
                                                                            ?>
                                                                        <h6 class="text-sm responsivetext"><span style="color:green"> Uploaded By: </span><?= $instractorName->full_name ?></h6>
                                                                        <p class="text-muted text-sm responsivetext font-italic m-0 p-0">
                                                                            <?php echo Yii::$app->formatter->asRelativeTime($videos_note['upload_date']." ".$videos_note['upload_time']) ?>
                                                                        </p>

                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <a href="<?= Url::toRoute(['/videos-and-notes/download_video_and_notes','material_ID'=> ClassRoomSecurity::encrypt($videos_note['material_ID'])])?>" class="card-text  mt-0"><span><i class="fas fa-download mr-1 "></i>Download</span></a>
                                                                    </div>
                                                        </div>
                                                            
                                                            

                                                        <?php endif ?>



                                                        <?php if($videos_note['material_type'] == 'Notes'):?>


                                                           
                                                                <div class="row  m-2 p-2 bg-white shadow-lg">

                                                                    <div class="col-md-5 float-left mb-1 ">
                                                                        <a class="responsiveheader" href="<?= Url::toRoute(['/videos-and-notes/view_document','material_ID'=> ClassRoomSecurity::encrypt($videos_note['material_ID'])]) ?>"  class="document-body"><i class="fa fa-file-text text-primary"></i> <?php echo $videos_note['title'] ?></a>
                                                                    </div>
                                                                    <div class="col-md-4 m-0 mb-2 ">
                                                        
                                                                        <?php
                                                                        $instractorName = Instructor::findOne($videos_note['instructorID']);
                                                                        ?>
                                                                        <h6 class="text-sm responsivetext"><span style="color:green"> Uploaded By: </span><?= $instractorName->full_name ?></h6>
                                                                        <p class="text-muted text-sm responsivetext font-italic m-0 p-0">
                                                                            <?php echo Yii::$app->formatter->asRelativeTime($videos_note['upload_date']." ".$videos_note['upload_time']) ?>
                                                                        </p>

                                                                    </div>
                                                                    <div class="col-md-3">
                                    
                                                                        <a data-toggle="tooltip" data-title="Download" href="<?= Url::toRoute(['/videos-and-notes/download_video_and_notes', 'material_ID' => ClassRoomSecurity::encrypt($videos_note['material_ID'])]) ?>"  class="ml-2 mt-0"><i class="fas fa-download mr-1 "></i> Download</a>
                                                                    </div>
                                                                </div>
                                                           

                                                        <?php endif ?>

                                                    
                                                    <?php endforeach; ?>
                                                    </div>
                                                    </div>

                                                
                                                <?php
                                                $module_count--;
                                                ?>
                                            </div>
                                    <?php endforeach; ?>
                                    
                                             </div>
                                            
                               
                                </div>
                                <!-- ########################################### Course materials end ######################################## -->
                            </div>
                        </div>
                                                        </div>
                </section>
            </div>
        </div><!--/. container-fluid -->
    </div>
</div>

