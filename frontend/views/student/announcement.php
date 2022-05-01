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

                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### announcements ######################################## -->

                                    <section class="col-lg-12">
                                        <!-- Custom tabs (Charts with tabs)-->
                                     
                                          
                                                <div class="row">
                                                    <!-- <?= VarDumper::dump($announcement) ?> -->
                                                    <div class="col-md-12">
                                                        <?php
                                                        if(empty($announcement)){
                                                            echo "<p class='text-muted text-lg text-center'>";
                                                            echo "No any announcement found";
                                                            echo "</p>";
                                                        }
                                                        ?>

                                                        <table class="table table-bordered table-striped text-sm" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                                                            <thead>
                                                            <tr>
                                                                <th width="1%">PostID</th><th>Title</th><th>Posted by</th><th>Date</th><th>View</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $i=0; ?>
                                                            <?php foreach($announcement as $announcement): ?>
                                                                <tr>
                                                                    <td><?= ++$i; ?></td>
                                                                    <td><?= $announcement->title ?> </td>
                                                                    <td>
                                                                        <?php
                                                                        $instractorName = Instructor::findOne($announcement->instructorID);
                                                                        echo $instractorName->full_name;
                                                                        ?>
                                                                    </td>
                                                                    <td><?= $announcement->ann_date. ' '.$announcement->ann_time;  ?></td>
                                                                    <td>
                                                                        <a class="model">
                                                                            <?php
                                                                            date_default_timezone_set('Africa/Dar_es_Salaam');
                                                                            Modal::begin([
                                                                                'title' =>  Html::tag('h2','Announcement', ['class' => 'float-center']),
                                                                                'toggleButton' => ['label' => Html::tag('a','', ['class' => 'fa fa-eye fa-lg shadow btn-sm btn text-primary'])],
                                                                                'size' => 'modal-lg',
                                                                                'centerVertical' => true,
                                                                                'footer' => Html::button('Close', ['class' => 'btn btn-primary float-right', 'data-dismiss' => 'modal']),
                                                                            ]);

                                                                            echo "    <div style='text-align:center'>";
                                                                            echo "<P class='announcement-model'> $announcement->content </P>".'<br>'.'<br>';
                                                                            echo "    </div>";
                                                                            echo "<p 'class' = 'text-muted'  style='  font-style: italic;'>";
                                                                            echo  Yii::$app->formatter->asRelativeTime($announcement->ann_date." ".$announcement->ann_time);
                                                                            echo "    </p>";

                                                                            Modal::end();
                                                                            ?>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                            </tbody>
                                                        </table>
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
