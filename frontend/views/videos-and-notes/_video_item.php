<?php


use yii\helpers\Url;
use common\models\Instructor;

/** @var $model \common\models\Materials */
?>

<div class="card m-3" style="width: 20rem;">
    <a href="#">
        <div class="embed-responsive embed-responsive-16by9">
            <video  width="320" height="180" class="embed-responsive-item m-0">
            
            <source  src="<?php echo $model->getVideoAndNotesLink() ?>" type='video/mp4' size="576"/>
            <source  src="<?php echo $model->getVideoAndNotesLink() ?>" type='video/mp4' size="720"/>
            <source  src="<?php echo $model->getVideoAndNotesLink() ?>" type='video/mp4' size="1080"/>
            
            </video>
        </div>
        <!-- <?= 
        var_dump($model->getVideoAndNotesLink());

        ?> -->

    </a>


    <div class="card-body p-2">
        <h6 class="card-title m-0"><?php echo $model->title ?></h6>
        <div class='row card-text'>
            <div class="col-sm-6 m-0">
                    <p class="text-muted m-0 p-0">
                        <?php 
                        $instractorName = Instructor::findOne($model->instructorID);
                        echo $instractorName->full_name;
                        ?>
                        <br>
                        <?php echo Yii::$app->formatter->asRelativeTime($model->upload_date." ".$model->upload_time) ?>
                    </p>
                    
            </div>

            <div class="col-sm-6">
                <a href="<?= Url::toRoute(['/videos-and-notes/download_video_and_notes','material_ID'=> $model->material_ID])?>" class="card-text float-right mt-0"><span><i class="fas fa-download fa-2x"></i></span></a>
            </div>
        </div>
        
    </div>
</div>
