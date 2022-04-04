<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QMarks */

$this->title = 'Update Q Marks: ' . $model->qmarks_id;
$this->params['breadcrumbs'][] = ['label' => 'Q Marks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qmarks_id, 'url' => ['view', 'id' => $model->qmarks_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qmarks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
