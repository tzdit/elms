<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Department */

$this->title = 'Update Department: ' . $model->departmentID;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->departmentID, 'url' => ['view', 'id' => $model->departmentID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
