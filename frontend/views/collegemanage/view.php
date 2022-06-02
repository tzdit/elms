<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\College */

$this->title = "View College";
$this->params['courseTitle']="<i class='fa fa-school'></i> View College";
$this->params['breadcrumbs'][] = ['label' => 'Colleges', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="college-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'collegeID',
            'college_name',
            'college_abbrev',
        ],
    ]) ?>

</div>
