<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuizThread */

$this->title = 'Create New Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Quiz Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-thread-create">
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
