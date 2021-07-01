<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Course;

use yii\bootstrap4\Breadcrumbs;

?>

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
                                ]); ?>

                                <?php 
                                echo $form->field($model, 'course_code')->dropDownList(ArrayHelper::map(Course::find()->select(['course_name','course_code'])->all(),'course_code','course_name'),['class' => 'form-control inline-block']) ?>


                                <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
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
