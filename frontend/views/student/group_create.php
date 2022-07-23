<?php

use common\models\GroupGenerationTypes;
use common\models\Student;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Course;
use yii\helpers\VarDumper;

use yii\bootstrap4\Breadcrumbs;

?>

<!-- <?= VarDumper::dump($model) ?> -->

<div class="site-index">

    <div class="body-content">
        <div class='container-fluid'>
            <div class="row">
                <div class="col-sm-12 text-sm">
                            <div class="row d-flex justify-content-center " style="font-family:'Times New Roman', sans-serif">

                                        <div class="col-xs-6 text-success text-md text-center"> <i class="fa fa-info-circle"></i> You will automatically be added to the group you create</div>
                                    </div>
                                    <div class="course-form">

                                        <?php $form = ActiveForm::begin([
                                            'enableClientValidation' => true,
                                            'id' => 'add-carry-form',
                                            'enableAjaxValidation'=> false,
                                        ]); ?>

                                        <?= $form->field($model, 'groupName')->textInput(['class' => 'col-sm-12 mt-2','placeholder'=>'--Group Name Ex: group one, group 1', 'size' => 100])->label(false) ?>

                                        <?php

                                        echo $form->field($model, 'generation_type')->dropDownList(ArrayHelper::map(GroupGenerationTypes::find()->
                                        select(['typeID','generation_type','max_groups_members'])
                                            ->where('course_code = :cid AND creator_type = :creator_type', [':cid' => $cid, 'creator_type' => 'instructor-student' ])
                                            ->orderBy(['typeID' => SORT_DESC])
                                            ->all(),'typeID',
                                            function ($model)
                                            {
                                                $maxMember = $model->max_groups_members - 1;
                                                return $model->generation_type." "." ("."maximum of ".$maxMember." students and you".")";
                                            }
                                        ),['prompt'=>'--Select module--','class' => 'form-control inline-block'])
                                            ->label(false)

                                        ?>

                                        <?php

                                        echo $form->field($model,'memberStudents[]')->dropDownList(ArrayHelper::map(Student::find()->
                                        select(['student.reg_no', 'student.fname', 'student.mname', 'student.lname'])
                                            ->join('INNER JOIN', 'program', 'student.programCode = program.programCode')
                                            ->join('INNER JOIN', 'program_course', 'program.programCode = program_course.programCode')
                                            ->join('LEFT JOIN', 'student_group', 'student.reg_no = student_group.reg_no')
                                            ->where(' program_course.course_code = :course_code AND student.reg_no != :reg_no', [':course_code' => $cid, ':reg_no' => Yii::$app->user->identity->username])
                                            ->orderBy(['student.fname' => SORT_ASC])
                                            ->asArray()
                                            ->all(),'reg_no',
                                            function ($model){
                                                return $model['fname']." ".$model['mname']." ".$model['lname']." - ".$model['reg_no'];
                                            }
                                        ),['data-placeholder'=>'--Select group members --','class' => 'form-control form-control-sm','id' => 'group_create', 'multiple'=>true,'style'=>'width:100%'])->label(false);

                                        ?>

                                        <div class="form-group">
                                            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-plus-circle"></i> Create'), ['class' => 'btn btn-primary float-right']) ?>
                                        </div>



                                        <?php ActiveForm::end(); ?>

                                    </div>

                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
$script = <<<JS
$(document).ready(function(){
  $('#group_create').select2();
  
});
JS;

$this->registerJs($script);

?>

