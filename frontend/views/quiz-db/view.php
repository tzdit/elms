<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuizDb */

$this->title = $model->question_id;
$this->params['breadcrumbs'][] = ['label' => 'Quiz Dbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-db-view">

    <h5><?= Html::encode($this->title) ?></h5>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->question_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->question_id], [
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
            'courseID',
            'question_id',
            'question',
            'answer',
            'option_one',
            'option_two',
            'option_three',
            'option_four',
        ],
    ]) ?>

</div>
