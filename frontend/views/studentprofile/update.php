<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
$this->params['courseTitle']='<i class="fa fa-edit text-info"></i> Update Profile';
$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' =>'Profile', 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">

<h1 class="text-center">
    <?php
    $docshome = "storage/studentfiles/";
    $dir = yii::$app->user->identity->id;
    $path = $docshome . $dir . "/";
    $name = "profilepic";
    $fullpath = $path . $name . ".png";
     if(file_exists($fullpath))
     {
        ?>
        <img class="img-rounded img-circle" height=130 width=130 src="/<?=$fullpath?>" />
        <?php
       

     } else {


        ?>
    <i class='fa fa-user-circle fa-2x text-info'></i>
    <?php
    }
    ?>
</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
