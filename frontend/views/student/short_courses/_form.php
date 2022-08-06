<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Course;
use yii\helpers\VarDumper;

use yii\bootstrap4\Breadcrumbs;

$courses=ArrayHelper::map(Course::find()->where(['type'=>'short_course'])->all(),'course_code','course_name');

?>

<!-- <?= VarDumper::dump($model) ?> -->

<div class="site-index">

<div class="body-content">
    <div class='container-fluid'>
        <div class="row">
            <div class="col-sm-12">
            <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="card" style="font-family:'Times New Roman', sans-serif">

                    <div class="card-body">
                       
                            <div class="course-form">

                                <?php $form = ActiveForm::begin([
                                    'enableClientValidation' => true,
                                    'id' => 'add-carry-form',
                                    'enableAjaxValidation'=> false,
                                ]); ?>

                                <?php 
                                echo $form->field($model, 'course_code')->dropDownList($courses,['prompt'=>'--Select Course--','class' => 'form-control inline-block']) ?>


                                <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', '<i class="fa fa-plus-circle"></i> Register Course'), ['class' => 'btn btn-sm btn-info']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>

                                </div>

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
