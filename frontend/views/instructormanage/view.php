<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Instructor */

$this->title = $model->instructorID;
$this->params['breadcrumbs'][] = ['label' => 'Instructors', 'url' => ['instructor-list']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="instructor-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->instructorID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset password', ['update', 'id' => $model->instructorID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->instructorID], [
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
            'instructorID',
            'userID',
            'departmentID',
            'full_name',
            'gender',
            'PP',
            'phone',
            'email:email',
        ],
    ]) ?>

</div>
