<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\College */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container pl-5 pr-5 pt-2 pb-3">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'college_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'college_abbrev')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-plus-circle"></i> Save', ['class' => 'btn btn-default float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
