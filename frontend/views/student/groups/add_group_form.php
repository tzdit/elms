<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;
use common\models\Course;

/* @var $this yii\web\View */
/* @var $model common\models\Groups */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="site-index">
<!-- <?= VarDumper::dump($model) ?> -->


<div class="body-content">
    <div class='container-fluid'>
        <div class="row">
            <div class="col-sm-12">
            <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="card" style="font-family:'Times New Roman', sans-serif">
                <div class="card-header text-center bg-primary">
<<<<<<< HEAD
                            <h2>Add Group</h2>
=======
                            <h2>Create Group</h2>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
                        </div>
                    <div class="card-body">
                       
                    <div class="groups-form">

                                    <?php $form = ActiveForm::begin(); ?>

                                    <?= $form->field($model, 'groupName')->textInput(['maxlength' => true]) ?>
                                    <?php 
                                    echo $form->field($model, 'course_code')->dropDownList(ArrayHelper::map(Course::find()->select(['course.course_name','course.course_code'])->where(['program_course.programCode' => $student_programme])->joinWith('programCourses')->all(),'course_code','course_name'),['prompt'=>'--Select--','class' => 'form-control inline-block'])->label('Choose Course Name') ?>


                                    <div class="form-group">
                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                    </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>










