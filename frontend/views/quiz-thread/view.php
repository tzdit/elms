<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuizThread */

$this->title = $model->quizID;
$this->params['breadcrumbs'][] = ['label' => 'Quiz Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-thread-view">

    <h5><?= Html::encode($this->title) ?></h5>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->quizID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->quizID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'quizID',
            'quiz_name',
            'numberQns',
            'total_marks',
            'duration',
            'status',
            'deadline',
        ],
    ]) ?>

</div>
