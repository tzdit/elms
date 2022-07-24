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
                   <div class="card shadow p-3 d-flex justify-content-center text-center text-primary">
                        
                    <a href="#" value="<?= Url::to(['/student/create-group', 'cid' => $cid]) ?>"  id = "group_modal_button">
                <i class="fa fa-plus-circle text-info"> </i> Create Group
            </a>
                            
                            <?php
                            Modal::begin([
                                'title'=>'<span class="text-info text-md"><i class="fa fa-plus-circle"></i> Create Group</span>',
                                'id' => 'group_modal',
                                'size' => 'modal-lg'
                            ]);

                            echo "<div id = 'group_modal_content'></div>";
                            Modal::end();
                            ?>

                        </div>
                           
                                        <div class="tab-content" id="custom-tabs-four-tabContent">


                                            <!-- ########################################### group by  instructor ######################################## -->

                                            <!-- Left col -->
                                            <section class="col-lg-12">


                                                <div class="card-body" >
                                                    <div class="tab-content" id="custom-tabs-four-tabContent">

                                                        <?php
                                                        if(empty($studentGroupsList)){
                                                            echo "<p class='text-muted text-lg text-center'>";
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
                                                                                            <h3><img src="<?= Yii::getAlias('@web/img/groupWork.png') ?>" width="40" height="40" class="mt-1"> <span class="assignment-header "><?php echo $item['generation_type']." ";?><span class="font-italic text-info text-sm font-weight-normal"><?php echo "(".$item['groupName'].")"; ?></span></span></h3>
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
                                                                                                        <h5 class="text-primary" data-toggle="tooltip" data-title="Exit group"><a href="#" class="exitgroup float-right mr-2 mt-3" groupID = "<?= $item['groupID'] ?>" ><i class="fa fa-sign-out-alt fa-lg text-danger"></i></a></h5>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </h2>
                                                                       

                                                                        <div id="collapse<?=$count?>" class="collapse" aria-labelledby="heading<?=$count?>" data-parent="#accordionExample_3">
                                                                            <!--end of displaying assignment-->
                                                                            <?php
                                                                            $studentList = StudentGroup::find()->select('student.fname, student.mname, student.lname, student.reg_no, student.programCode, student.phone ')->join('INNER JOIN', 'student', 'student.reg_no = student_group.reg_no')->where('groupID = :groupID ', [':groupID' => $item['groupID']])->asArray()->all();
                                                                            ?>
                                                                     
                                                            

                                                                                    <div class="p-5">
                                                                                        <div class="row bg-primary p-2">
                                                                                         <div class="col-sm-9"> Group Members</div>
                                                                                         <div class="col-sm-3">
                                                                                         <?php if ($group->isCreator($regno)): ?>
                                                                                    <a href="#" class="btn btn-sm btn-default shadow btn-rounded float-right mb-2" data-target="#addStudentModal<?= $item['groupID'] ?>" data-toggle="modal"><i class="fa fa-plus-circle text-info" ></i> Add member</a>
                                                                                    <?php endif ?>
                                                                                        </div>
                                                                                            </div>
                                                                                        <!-- -----------------------------group members ---------------------------------------->
                                                                                        <?php foreach ($studentList as $student) : ?>
                                                                                            <div class="text-sm row p-1 bg-white shadow-lg">
                                                                                                <div class="p-1 col-sm-2 text-muted" ><?=ucfirst(strtolower($student['fname'])) ?> </div>
                                                                                                 <div class="p-1 col-sm-1 text-muted" ><?= ucfirst(strtolower($student['mname'])) ?> </div>
                                                                                                 <div class="p-1 col-sm-2 text-muted" > <?= ucfirst(strtolower($student['lname'])) ?> </div>
                                                                                                 <div class="p-1 col-sm-3 text-muted" > <?= $student['reg_no'] ?> </div>
                                                                                                 <div class="p-1 col-sm-2 text-muted" ><?= $student['programCode'] ?> </div>
                                                                                                 <div class="p-1 col-sm-1 text-muted" > <?= $student['phone'] ?> </div>
                                                                                                 <div class="p-1 col-sm-1 text-sm">
                                                                                                     <?php
                                                                                                        $regno=yii::$app->user->identity->username;
                                                                                                        $creator=Groups::findOne($item['groupID'])->isCreator($regno);
                                                                                                        $isme=$student['reg_no']==$regno;

                                                                                                        if($creator==true && $isme==false){
                                                                                                     ?>
                                                                                                     <?= Html::a('<i class="fa fa-trash inner text-danger" data-toggle="tooltip" data-title="Remove Member"></i>',['remove-student-from-group', 'reg_no'=>$student['reg_no'], 'groupID'=>$item['groupID'] ], ['class'=>'text-danger  m-0'])?>
                                                                                                     <?php
                                                                                                        }
                                                                                                     ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php endforeach; ?>
                                                                                    </div>

                                                                                <!--       ---- -----  ---                  another start modal-->
                                                                                <div class="modal fade" id="addStudentModal<?= $item['groupID'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header bg-primary p-2 pl-3">
                                                                                                <span class="modal-title text-sm" id="addStudentModal<?= $item['groupID'] ?>"><i class="fa fa-plus-circle text-info"></i> Add Member</span>

                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/student/add-students-to-group', 'groupID'=>$item['groupID' ]]])?>

                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <?= $form->field($model,'memberStudents[]')->dropdownList($stds,['class'=>'form-control form-control-sm','id'=>'assignstudents3','data-placeholder'=>'--Choose Members--','multiple'=>'multiple','style'=>'width:100%'])->label(false)?>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">
                                                                                                        <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Add', ['class'=>'btn btn-outline-primary btn-sm float-right ml-2']) ?>
                                                                                                        <button type="button" class="btn btn-secondary btn-sm float-right" data-dismiss="modal">Close</button>

                                                                                                    </div>
                                                                                                </div>
                                                                                                <?php ActiveForm::end()?>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                    </div>
                                                                    <?php
                                                                    $count--;
                                                                    ?>
                                                                </div></div>
                                                                    <?php endforeach; ?>


                                                      

                                                    </div>
                                                    <!-- ########################################### GROUPS END ######################################## -->
                                              



                                            </section>
                                            <!-- ########################################### group by instructor end ######################################## -->
                                    
                             
                             

                                                           



                               

                                            <?php $script = <<<JS
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




