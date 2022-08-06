<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ShortcourseAdvert */

$this->title = $model->title;
$this->params['courseTitle']="<i class='fa fa-bullhorn text-info'></i> ".$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Shortcourse Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = "view course";
\yii\web\YiiAsset::register($this);
?>
<div class="shortcourse-advert-view">
    <p>
    <?= Html::a('<i class="fa fa-trash"></i> Delete', ['delete', 'id' => $model->advID], [
            'class' => 'btn btn-danger float-right mb-2',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa fa-edit"></i> Update', ['update', 'id' => $model->advID], ['class' => 'btn btn-info float-right mr-1 mb-2']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'course_code',
            'title',
            'description',
            'deadlinedate',
            'deadlinetime',
        ],
    ]) ?>

</div>
