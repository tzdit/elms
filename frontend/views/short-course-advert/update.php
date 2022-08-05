<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShortcourseAdvert */

$this->title = 'Update Shortcourse Advert: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Shortcourse Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->advID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shortcourse-advert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
