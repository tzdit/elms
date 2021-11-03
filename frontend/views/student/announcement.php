<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use common\models\Material;
use common\models\Instructor;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\Submit;
use common\models\GroupAssignmentSubmit;
use frontend\models\UploadMaterial;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
$this->params['courseTitle'] =$cid;
$this->title = 'Class';
$this->params['breadcrumbs'] = [
    ['label'=>'Class', 'url'=>Url::to(['/student/classwork', 'cid'=>$cid])],
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

                    <div class="card-header p-0 border-bottom-0 ml-3">
                        <h2>Announcement</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### announcements ######################################## -->

                                    <section class="col-lg-12">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title com-sm-12 text-secondary">
                                                    <i class="fas fa-book mr-1"></i>
                                                    My results

                                                    Announcements
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- <?= VarDumper::dump($announcement) ?> -->
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered table-striped" id="CoursesTable" style="width:100%; font-family: 'Times New Roman'">
                                                            <thead>
                                                            <tr>
                                                                <th width="1%">PostID</th><th>Title</th><th>Posted by</th><th>Date</th><th>Action</th>
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
                                                                            Modal::begin([
                                                                                'title' =>  Html::tag('h2','Announcement', ['class' => 'float-center']),
                                                                                'toggleButton' => ['label' => Html::tag('a','Click to Read', ['class' => 'fa fa-eye fa-lg '])],
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
                                            </div>
                                        </div>
                                    </section>
                                <!-- ########################################### announcements end ####################################### -->
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
