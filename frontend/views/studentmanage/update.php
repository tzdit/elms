<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Update Student: ' . $model->reg_no;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['student-list']];
$this->params['breadcrumbs'][] = ['label' => $model->reg_no, 'url' => ['view', 'id' => $model->reg_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
