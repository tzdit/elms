<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['courseTitle']="<i class='fa fa-school text-info'></i> Colleges";
$this->title="Colleges";
$this->params['breadcrumbs'] = [
    ['label'=>$this->title]
];
?>
<div class="college-index text-sm">


    <p>
        <?= Html::a('<i class="fa fa-plus-circle text-info"></i> Add College',['#'], ['class' => 'btn btn-default float-right mb-2','data-toggle'=>'modal','data-target'=>'#collegemodal']) ?>
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

<?=$this->render('addCollege')?>
</div>
