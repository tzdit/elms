<?php

use common\models\Course;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\ForumQuestionForm */
/* @var $form ActiveForm */

$this->params['courseTitle'] ='EDIT THREAD';
$this->title = 'Add Thread';
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];


?>
<div class="thread_form container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_tittle')->label('Tittle') ?>
    <?= $form->field($model, 'question_desc')->textarea(['rows' => 10, 'maxlength' => 1000, 'row' => 50, 'placeholder' => 'Write your question here with in short words' ])->label('Question Body') ?>
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

