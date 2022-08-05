<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ShortcourseAdvert */

$this->title = 'Create Shortcourse Advert';
$this->params['breadcrumbs'][] = ['label' => 'Shortcourse Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shortcourse-advert-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
