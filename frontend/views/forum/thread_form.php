<?php

use common\models\Course;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

use kartik\file\FileInput;


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

    <div class="card p-5">

        <?php $form = ActiveForm::begin([
            'options'=>['enctype'=>'multipart/form-data']

        ]);

        ?>

        <?= $form->field($model, 'question_tittle')->label('Question Tittle') ?>
        <?= $form->field($model, 'question_desc')->textarea(['class'=>'form-control form-control-sm', 'rows' => 17, 'maxlength' => 1000, 'row' => 50, 'placeholder' => 'Write your question here with in short words' ])->label('Question Body') ?>
        <?= $form->field($model,'coursesTag[]')->dropDownList(ArrayHelper::map(Course::find()->select(['course_name','course_code'])->all(),'course_code','course_name'),['data-placeholder'=>'--Search course to tag --','class' => 'form-control form-control-sm','id' => 'courses_tag', 'multiple'=>true,'style'=>'width:100%'])->label("Tags") ?>

        <p>
            <a class="btn btn-success" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                Code snippets(Optional)
            </a>
        </p>
        <div class="collapse" id="collapseExample1">
            <div class="card card-body">
                <?= $form->field($model, 'code')->textarea(['class'=>'form-control form-control-sm', 'rows' => 7, 'maxlength' => 1000, 'row' => 15, 'placeholder' => 'write your code snippets for clarification if you have any', 'style'=>'width:70%' ])->label('Code  Snippets') ?>
            </div>
        </div>

        <p>
            <a class="btn btn-success" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Image for attachment(Optional)
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">

                <div class="row">
                    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => TRUE,],
                    ])->label('Choose to select image if you have any');   ?>
                </div>

            </div>
        </div>

        <div class="form-group ">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-outline-dark  float-right font-weight-bold']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

</div><!-- thread_form -->



<?php
$script = <<<JS
$(document).ready(function(){
  $('#courses_tag').select2();
  
});
JS;

$this->registerJs($script);

?>

