<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuizDb */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-db-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer')->dropDownList(
            ['a' => 'a', 'b' => 'b', 'c' => 'c','d' => 'd']
    ) ?>

    <?= $form->field($model, 'option_one')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_two')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_three')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'option_four')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
