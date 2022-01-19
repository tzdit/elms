<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QMarks */

$this->title = 'Create Q Marks';
$this->params['breadcrumbs'][] = ['label' => 'Q Marks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qmarks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
