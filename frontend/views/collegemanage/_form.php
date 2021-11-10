<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\College */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="college-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'college_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'college_abbrev')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
