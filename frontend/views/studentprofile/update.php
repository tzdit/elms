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

<h1 class="text-center"><i class='fa fa-user-circle fa-2x text-info'></i></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
