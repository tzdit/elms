<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List of Colleges';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="college-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Create College', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'collegeID',
            'college_name',
            'college_abbrev',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
