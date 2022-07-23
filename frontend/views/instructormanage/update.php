<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Instructor */
$this->params['courseTitle']="<i class='fa fa-edit'></i> Update User";
$this->title = 'Update';
$this->params['breadcrumbs'][] = ['label' => 'Instructors', 'url' => ['instructor-list']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instructor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
