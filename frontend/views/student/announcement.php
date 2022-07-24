<?php
use common\models\Instructor;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;
use frontend\models\ClassRoomSecurity;

/* @var $this yii\web\View */
$this->params['courseTitle'] ='<img src="/img/announcement.png" height="25px" width="25px"/> '.$cid.' Announcements';
$this->title ='Announcements';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Dashboard', 'url'=>Url::to(['/student/classwork', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
    ['label'=>"Notice board"]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">

            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">

                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### announcements ######################################## -->

                                    <section class="col-lg-12">
                                        <!-- Custom tabs (Charts with tabs)-->
                                     
                                          
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php
                                                        if(empty($announcement)){
                                                            echo "<p class='text-muted text-lg p-2 text-center'>";
                                                            echo "No any announcement found";
                                                            echo "</p>";
                                                        }
                                                        ?>
                                                        <div class="accordion" id="accordionExample_4">
            
                                                            <?php 
                                                            date_default_timezone_set('Africa/Dar_es_Salaam');
                                                            foreach($announcement as $announcement):
                                                             ?>

                                                                <div class="card shadow-lg" data-toggle="collapse" data-target="#collapse<?=$announcement->annID?>" aria-expanded="true" aria-controls="collapse<?=$announcement->annID?>">
                                                    <div class="card-header p-2" id="heading<?=$announcement->annID?>">
                                                        <h2 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-sm-11">
                                                                    <button class="btn btn-link btn-block text-left col-md-11" type="button" >
                                                                        <h5 class="responsiveheader"><img src="/img/announcement.png" height="25px" width="25px"/> <span class="assignment-header responsiveheader"><?php echo $announcement->title ;?></span></h5>
                                                                    </button>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <i class="fas fa-ellipsis-v float-right text-secondary text-sm"></i>
                                                                </div>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse<?=$announcement->annID?>" class="collapse" aria-labelledby="heading<?=$announcement->annID?>" data-parent="#accordionExample_4">
                                                        <div class="card-body">
                                                            <p><span class="text-sm responsivetext text-primary"> <?= $announcement->content ?></span></p>
                                                        </div>
                                                        <div class="card-footer bg-white border-top">
                                                            <div class="row p-1 textthumb">
                                                                <div class="col-sm-12 p-0 text-muted  textthumb">
                                                                   
                                                                    <?php
                                                                        $instructorName = Instructor::findOne($announcement->instructorID);
                                                                        ?>
                                                                        <span class="float-left"> by <?=$instructorName->full_name?></span>
                                                                         <span class="float-right">
                                                                             <?=
                                                                                $announcement->ann_date.' '.$announcement->ann_time;
                                                                         ?>
                                                            </span>
                                                                </div>
                                                               
                                                             
                                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                              
                                            </div>
                
                                                             
                                                               
                                                                  
                                                                    
                                                                      
                                                            
                                                            <?php endforeach ?>
                                                            </div>
                                                    </div>
                                            
                                            </div>
                                        
                                    </section>
                                <!-- ########################################### announcements end ####################################### -->
                          
                        </div>
                    </div>
                </section>
            
        </div><!--/. container-fluid -->
    </div>
</div>

<?php
$script = <<<JS
$(document).ready(function(){

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
