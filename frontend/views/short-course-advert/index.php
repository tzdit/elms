<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shortcourse Adverts';
$this->params['courseTitle']="<i class='fa fa-bullhorn text-info'></i> Course advertisements";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="shortcourse-advert-index">



        <?= Html::a('<i class="fa fa-bullhorn"></i> Advertise Course', ['create'], ['class' => 'btn btn-info float-right mb-2']) ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'advID',
            'course_code',
            'title',
            'description',
            'deadlinedate',
            //'deadlinetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
