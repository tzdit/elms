<?php
use yii\helpers\Url;


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
                        <h2>Returned</h2>

                    </div>

                    <div class=" card-primary card-outline card-outline-tabs">
                        <div class="card-body" >
                            <div class="tab-content" id="custom-tabs-four-tabContent">


                                <!-- ########################################### returned marks ######################################## -->

                                    <!-- Left col -->
                                    <section class="col-lg-12">


                                        <?php foreach($returned as $returne): ?>
                                            <?php foreach($returne->submits as $submit_returne): ?>

                                                <div class="card">
                                                    <div class="card m-3 shadow-lg rounded result-card">
                                                        <div class="card-body">
                                                            <div class="m-0">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <h5><i class="fas fa-clipboard-list mr-1 fa-lg" ></i><?php echo " ".ucwords($returne->assName) ?> </h5>
                                                                        <span class="text-muted mt-0"><?= ucfirst($returne->assType) ?> Assignment</span>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="float-right mr-4">
                                                                            <b><span class="text-muted">Total:</span> <span style="color: #007bff;"><?= $returne->total_marks  ?></span> </b><br>
                                                                            <b><span class="text-muted">Score:</span> <span style="color: #007bff;"><?= $submit_returne->score ?></span></b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="m-0">
                                                                <p>File Name: <span class="m-0" style="color: #007bff;
                                                                    font-style: italic;"><?= substr($submit_returne->fileName, -30);  ?></span></p>
                                                            </div>

                                                            <div class="m-0">
                                                                <div class="row">
                                                                    <div class="col-sm-3"></div>
                                                                    <div class="col-sm-6">
                                                                        <p>Comment: <span class="text-muted m-0"><?php
                                                                                if (is_null($submit_returne->comment)){
                                                                                    echo "No comment";
                                                                                }
                                                                                else
                                                                                    echo $submit_returne->comment;

                                                                                ?></span></p>
                                                                    </div>
                                                                    <div class="col-sm-3"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach ?>
                                        <?php endforeach ?>

                                    </section>
                                <!-- ########################################### returned marks end ######################################## -->
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
