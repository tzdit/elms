<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
$this->params['courseTitle']="<i class='fa fa-user-circle text-info'></i> My Profile";
$this->title = "My Profile";
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-view responsivetext">

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

        <p class="text-center m-0"><?= Html::a('<i class="fa fa-edit text-success"></i> Update Profile', ['update'], ['class' => 'btn btn-light border m-1']) ?></p>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'reg_no',
            'programCode',
            'fname',
            'mname',
            'lname',
            'email:email',
            'gender',
            'f4_index_no',
            'YOS',
            'DOR',
            'phone',
            'status',
        ],
    ]) ?>

</div>
