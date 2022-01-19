<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quiz Threads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-thread-index"> 
	<div class="container-fluid admin">
    <a href="../quiz-thread/create" class="btn btn-primary btn-sm float-right m-0 col-xs-12"><i class="fa fa-plus"></i> Create Quiz</a>
    <a href="../quiz-db/index" class="btn btn-primary btn-sm float-left m-0 col-xs-12"><i class="fa fa-home"></i> Question Bank</a>
		<br>
		<br>
		<div class="card col-md-12 mr-4" style="float:left">
			<div class="card-header">
				Available Quiz
			</div>
			<div class="card-body">
				
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'quizID',
            'quiz_name',
            'numberQns',
            'total_marks',
            'duration',
            'status',
            'deadline',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

		    </div>
	</div>
</div>
