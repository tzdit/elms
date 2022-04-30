<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Student;
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
$this->params['courseTitle'] ='<img src="/img/groupass.png" height="25px" width="25px"/> '.$cid." Groups";
$this->title = 'Groups';
$this->params['breadcrumbs'] = [
    ['label'=>$cid.' Dashboard', 'url'=>Url::to(['classwork','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
];

?>


<div class="site-index">
    <div class="body-content">
        <!-- Content Wrapper. Contains page content -->

        <div class="container-fluid">
           
            <div class="row">

                <section class="col-lg-12">
                    <div class="card card-primary p-2 card-outline card-outline-tabs">
                        <div class="card-header">
                    <a value="<?= Url::to(['/student/create-group', 'cid' => $cid]) ?>"  id = "group_modal_button">
                <button type="submit" class="btn btn-default text-primary float-right mt-3 mr-5" style="margin-left: 2px;"><i class="fa fa-plus-circle"> </i> Create Group</button>
            </a></div>
                            
                            <?php
                            Modal::begin([
                                'title'=>'<span class="text-primary text-md"><i class="fa fa-plus-circle"></i> Create Group</span>',
                                'id' => 'group_modal',
                                'size' => 'modal-lg'
                            ]);

                            echo "<div id = 'group_modal_content'></div>";
                            Modal::end();
                            ?>

                        <div class="card-body">
                           
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### group by  instructor ######################################## -->

                                            <!-- Left col -->
                                            <section class="col-lg-12">


                                                <div class="card-body" >
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">

                                                        <?php
                                                        if(empty($studentGroupsList)){
                                                            echo "<p class='text-muted text-lg'>";
                                                            echo "No group found";
                                                            echo "</p>";
                                                        }
                                                        ?>

                                                        <!-- ########################################### GROUPS ######################################## -->

                                                        <div class="accordion" id="accordionExample_3">
                                                            <?php foreach( $studentGroupsList as $item ) : ?>
                                                             
                                                                    <div class="card shadow-lg">
                                                                        <div class="card-header p-2" id="heading<?=$count?>">
                                                                            <h2 class="mb-0">
                                                                                <div class="row">
                                                                                    <div class="col-sm-8">
                                                                                        <button class="btn btn-link btn-block text-left col-md-11" type="button" data-toggle="collapse" data-target="#collapse<?=$count?>" aria-expanded="true" aria-controls="collapse<?=$count?>">
                                                                                            <h3><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header "><?php echo $item['generation_type']." ";?><span class="font-italic text-info font-weight-normal"><?php echo "(".$item['groupName'].")"; ?></span></span></h3>
                                                                                        </button>

                                                                                    </div>
                                                                                    <div class="col-sm-4">

                                                                                        <?php

                                                                                        $regno=yii::$app->user->identity->username;
                                                                                        $group = Groups::findOne($item['groupID']);
                                                                                        ?>

                                                                                        <?php if ($group->isCreator($regno)): ?>
                                                                                            <h5 class="text-danger mt-3" data-toggle="tooltip" data-title="Delete group"><a href="#" class="btn-delete-group float-right mr-2" id = "btn-delete-group" groupID = "<?= $item['groupID'] ?>" ><i class="fas fa-times-circle fa-lg carry-delete"></i></a></h5>
                                                                                            <?php else: ?>
                                                                                                        <h5 class="text-primary" data-toggle="tooltip" data-title="Exit group"><a href="#" class="exitgroup float-right mr-2 mt-3" groupID = "<?= $item['groupID'] ?>" ><i class="fa fa-sign-out-alt fa-lg "></i></a></h5>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </h2>
                                                                        </div>

                                                                        <div id="collapse<?=$count?>" class="collapse" aria-labelledby="heading<?=$count?>" data-parent="#accordionExample_3">
                                                                            <!--end of displaying assignment-->
                                                                            <?php
                                                                            $studentList = StudentGroup::find()->select('student.fname, student.mname, student.lname, student.reg_no, student.programCode, student.phone ')->join('INNER JOIN', 'student', 'student.reg_no = student_group.reg_no')->where('groupID = :groupID ', [':groupID' => $item['groupID']])->asArray()->all();
                                                                            ?>
                                                                            <div class="card">
                                                                                <div class="card-header p-2">
                                                                                    <h3 class="card-title com-sm-12">
                                                                                        <i class="fas fa-list mr-1 text-info"></i>
                                                                                        List of Students in a group

                                                                                    </h3>
                                                                                    <a href="#" class="btn btn-sm btn-outline-primary btn-rounded float-right mb-2" data-target="#addStudentModal<?= $item['groupID'] ?>" data-toggle="modal"><i class="fas fa-plus" ></i>Add Students</a>

                                                                                </div><!-- /.card-header -->

                                                                                <!--       ---- -----  ---                  another start modal-->
                                                                                <div class="modal fade" id="addStudentModal<?= $item['groupID'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header bg-primary">
                                                                                                <span class="modal-title" id="addStudentModal<?= $item['groupID'] ?>"><h4><i class="fas fa-users"></i> Add Students to a Group</h4></span>

                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/student/add-students-to-group', 'groupID'=>$item['groupID' ]]])?>

                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <?= $form->field($model,'memberStudents[]')->dropdownList($stds,['class'=>'form-control form-control-sm','id'=>'assignstudents3','data-placeholder'=>'Select degree Programs','multiple'=>'multiple','style'=>'width:100%'])->label('Students')?>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <?= Html::submitButton('Add', ['class'=>'btn btn-outline-primary btn-md float-right ml-2']) ?>
                                                                                                        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php ActiveForm::end()?>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>


                                                                                <!--        -----     -----            -----                     end of modal            -->




                                                                                <div class="card-body">
                                                                                    <table class="table table-bordered table-striped table-hover" id="CourseList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
                                                                                        <thead>
                                                                                        <tr><th width="1%">#</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Reg No</th><th>Program Code</th><th>Phone</th><th width="10%">Action</th></tr>
                                                                                        </thead>
                                                                                        <tbody>

                                                                                        <?php $i = 0; ?>
                                                                                        <?php foreach($studentList as $student): ?>
                                                                                            <tr>
                                                                                                <td><?= ++$i; ?></td>
                                                                                                <td><?= $student['fname'] ?></td>
                                                                                                <td><?= $student['mname'] ?></td>
                                                                                                <td><?= $student['lname'] ?></td>
                                                                                                <td><?= $student['reg_no'] ?></td>
                                                                                                <td><?= $student['programCode'] ?></td>
                                                                                                <td><?= $student['phone'] ?></td>
                                                                                                <td>
                                                                                                    <?= Html::a('<i class="fas fa-trash inner" data-toggle="tooltip" data-title="Remove Student"></i>',['remove-student-from-group', 'reg_no'=>$student['reg_no'], 'groupID'=>$item['groupID'] ], ['class'=>'btn btn-danger btn-sm m-0'])?>
                                                                                                </td>
                                                                                            </tr>

                                                                                            <!-- ################################################## -->
                                                                                        <?php endforeach; ?>
                                                                                        </tbody>
                                                                                    </table>

                                                                                </div>
                                                                        </div>

                                                                    </div>
                                                                    <?php
                                                                    $count--;
                                                                    ?>
                                                                </div>
                                                                    <?php endforeach; ?>


                                                      

                                                    </div>
                                                    <!-- ########################################### GROUPS END ######################################## -->
                                              



                                            </section>
                                            <!-- ########################################### group by instructor end ######################################## -->
                                        </div>
                             
                             

                                                           



                               





                                                                      

                                                                            <?php
                                                                            $script = <<<JS
                                                                            $(document).ready(function(){
                                                                         
                                                                            
                                                                            });
                                                                            JS;
                                                                            $this->registerJs($script);

                                                                            ?>

                                                                        </div>

                                                                </div>



                                                <!-- ########################################### group by student end ######################################## -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            </section>



            </div>
        </div>
    </div><!--/. container-fluid -->
</div>


<?php
$script = <<<JS
$(document).ready(function(){
  $("#CourseList").DataTable({
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
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>




