<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\College */

$this->title = 'Add College';
$this->params['courseTitle']="<i class='fa fa-plus-circle'></i> Add College";
$this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="college-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
