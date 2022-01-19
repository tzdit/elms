<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuizDb */

$this->title = 'Update Question: ' . $model->question_id;
$this->params['breadcrumbs'][] = ['label' => 'Quiz Dbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->question_id, 'url' => ['view', 'id' => $model->question_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quiz-db-update">

    <h5><?= Html::encode($this->title) ?></h5>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
