<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Course;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ShortcourseAdvert */
/* @var $form yii\widgets\ActiveForm */

$userdepat=yii::$app->user->identity->instructor->departmentID;
$courses =ArrayHelper::map(Course::find()->where(['type'=>'short_course','departmentID'=>$userdepat])->all(),'course_code','course_name');
?>
<style>
    .help-block{
        color:red
    }
</style>
<div class="container p-5">
<div class="shortcourse-advert-form">

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'Ad Title'])->label(false) ?>
    <?= $form->field($model, 'course_code')->dropDownList($courses,['maxlength' => true,'prompt'=>'--Short course--'])->label(false) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true,'placeholder'=>'Ad description'])->label(false) ?>
    <div class="row">
        <div class="col-sm-6">
    <?= $form->field($model, 'deadlinedate')->textInput(['placeholder'=>'Deadline Date','onmouseover'=>'this.type="date"','onmouseout'=>'this.type="text"'])->label(false) ?>
    </div>
    <div class="col-sm-6">
    <?= $form->field($model, 'deadlinetime')->textInput(['placeholder'=>'Deadline Time','onmouseover'=>'this.type="time"','onmouseout'=>'this.type="text"'])->label(false) ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-bullhorn"></i> Announce', ['class' => 'btn btn-info float-right col-sm-3']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
