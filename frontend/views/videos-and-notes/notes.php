<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['courseTitle'] =$cid;
$this->title = 'notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="v-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'file',
                'content' => function ($model) {
                    return $this->render('_notes_item', ['model' => $model]);
                }
            ],

            [
              'attribute' => 'title',
              'label' => 'File title',
              'enableSorting' => false
          ],


            [
              'attribute' => 'Uploaded by',
              'content' =>  function ($model) {
                    return $this->render('_instructor_item', ['model' => $model]);
                }
            ],

            [
              'attribute' => 'Download',
              'label' => 'Downlaod',
              'format' => 'raw',
              'value' => function ($model) {
                        
                      return  Html::a('',['/videos-and-notes/download_video_and_notes', 'material_ID' => $model->material_ID], ['class' => 'fas fa-download fa-2x mt-2 document-icon']);
            
               },
          ],
        ],
    ]); ?>


</div>
