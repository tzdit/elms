<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuizDb */

$this->title = 'Create Questions';
$this->params['breadcrumbs'][] = ['label' => 'Quiz Dbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-db-create">
		<div class="card col-md-12 mr-4" style="float:left">
			<div class="card-header">
			Add to Bank
			</div>
			<div class="card-body">
		
            <?= $this->render('_form', [
        'model' => $model,
            ]) ?>

		    </div>

</div>
