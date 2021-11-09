<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\College */

$this->title = 'Update College: ' . $model->collegeID;
$this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->collegeID, 'url' => ['view', 'id' => $model->collegeID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="college-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
