<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuizThread */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-thread-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quiz_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numberQns')->textInput() ?>

    <?= $form->field($model, 'total_marks')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deadline')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
