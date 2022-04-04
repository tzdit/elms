<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-db-index">

    <div class="container-fluid admin">
   
		<br>
		<div class="card col-md-12 mr-4" style="float:left">
			<div class="card-header">
            <?= Html::a('Create more', ['create'], ['class' => 'btn btn-primary']) ?>
			</div>
			<div class="card-body">
				
         
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'courseID',
           // 'question_id',
            'question',
            'answer',
            'option_one',
            'option_two',
            'option_three',
            'option_four',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


		    </div>
	</div>

</div>
