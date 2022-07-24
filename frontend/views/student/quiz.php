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
                        <h2>Quiz</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">

                                <!-- ########################################### quiz ######################################## -->
                                    <div class="accordion" id="accordionExample_4">

                                        <div class="row">


                                            <div class="container-fluid admin">
                                                <div class="col-md-12 alert alert-primary">My Quiz List</div>
                                                <br>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table table-bordered" id='table'>
                                                            <colgroup>
                                                                <col width="2%">
                                                                <col width="20%">
                                                                <col width="15%">
                                                                <col width="15%">
                                                                <col width="18%">
                                                                <col width="20%">
                                                            </colgroup>
                                                            <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Quiz</th>
                                                                <th>My Score</th>
                                                                <th>Total Score</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>MMMMMM</td>
                                                                <td>NNNNNNN</td>
                                                                <td>YYYYYYY</td>
                                                                <td>MMMMMMM</td>
                                                                <td>MMMMMMM</td>
                                                                <td>
                                                                    <center>
                                                                        <a class="btn btn-sm btn-outline-primary" href="<?= Url::toRoute(['student/quiz_answer'])?>"><i class="fa fa-pencil text-info"></i> Take Quiz</a>
                                                                    </center>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                <!-- ########################################### quiz end ################################# -->
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














