<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Module */

$this->title = 'Update Module: ' . $model->moduleID;
$this->params['breadcrumbs'][] = ['label' => 'Modules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->moduleID, 'url' => ['view', 'id' => $model->moduleID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="module-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
