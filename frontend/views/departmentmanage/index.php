<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List of Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Create Department', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'departmentID',
            'collegeID',
            'department_name',
            'depart_abbrev',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
