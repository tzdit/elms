<?php

use common\models\Course;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\ForumQuestionForm */
/* @var $form ActiveForm */

$this->params['courseTitle'] ='CREATE THREAD';
$this->title = 'Add Thread';
$this->params['breadcrumbs'] = [
    ['label'=>'Forum', 'url'=>Url::to(Yii::$app->request->referrer)],
    ['label'=>$this->title]
];


?>
<div class="thread_form container">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'question_tittle')->label('Tittle') ?>
        <?= $form->field($model, 'question_desc')->textarea(['rows' => 10, 'maxlength' => 1000, 'row' => 50, 'placeholder' => 'Write your question here with in short words' ])->label('Question Body') ?>
        <?= $form->field($model,'coursesTag[]')->dropDownList(ArrayHelper::map(Course::find()->select(['course_name','course_code'])->all(),'course_code','course_name'),['data-placeholder'=>'--Search course to tag --','class' => 'form-control form-control-sm','id' => 'courses_tag', 'multiple'=>true,'style'=>'width:100%'])->label("Tags") ?>

    <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- thread_form -->



<?php
$script = <<<JS
$(document).ready(function(){
  $('#courses_tag').select2();
  
});
JS;

$this->registerJs($script);

?>

