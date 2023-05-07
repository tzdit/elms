<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .help-block
    {
        color:red
    }
    </style>
<div class="container pl-5 pr-5 pt-2 pb-3">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row border pt-3 pl-2"><div class="col-6 col-sm-6">
    <?= $form->field($model, 'profilepic')->fileInput(['maxlength' => true])->label('Profile Picture') ?>
    </div>
    <div class="col-6 col-sm-6">
    <?= $form->field($model, 'documents[]')->fileInput(['multiple'=>true])->label('Certificates') ?>
    </div></div>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['M'=>'Male','F'=>'Female'],['maxlength' => true]) ?>

    <?= $form->field($model, 'f4_index_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-save"></i> Save Changes', ['class' => 'btn btn-default col-sm-6 mb-2 float-right bg-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
