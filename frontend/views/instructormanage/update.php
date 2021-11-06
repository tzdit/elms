<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Instructor */

$this->title = 'Update Instructor: ' . $model->instructorID;
$this->params['breadcrumbs'][] = ['label' => 'Instructors', 'url' => ['instructor-list']];
$this->params['breadcrumbs'][] = ['label' => $model->instructorID, 'url' => ['view', 'id' => $model->instructorID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instructor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
