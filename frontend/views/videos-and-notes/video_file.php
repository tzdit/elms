<?php


/** @var $dataProvider \yii\data\ActiveDataProvider */
$this->params['courseTitle'] =$cid;
$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
    ],
    'itemView' => '_video_item',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false
    ]
]) ?>
