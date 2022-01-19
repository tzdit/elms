<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuizThread */

$this->title = 'Update: ' . $model->quizID;
$this->params['breadcrumbs'][] = ['label' => 'Quiz Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->quizID, 'url' => ['view', 'id' => $model->quizID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quiz-thread-update">

<div class="card col-md-12 mr-4" style="float:left">
			<div class="card-header">
			<?= $this->title ?>
			</div>
			<div class="card-body">
		
            <?= $this->render('_form', [
        'model' => $model,
            ]) ?>

		    </div>
</div>
