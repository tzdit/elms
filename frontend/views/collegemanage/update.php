<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\College */

$this->title = 'Update College';
$this->params['courseTitle']="<i class='fa fa-edit'></i> Update College";
$this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="college-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
