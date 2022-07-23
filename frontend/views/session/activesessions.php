<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Sessionsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['courseTitle']="<i class='fa fa-sign-in-alt'></i> Sessions";
$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index" style="font-size:12px">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sessionid',
            'username',
            'role',
            'college',
            'prog_or_dept',
            'sessiontime',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
