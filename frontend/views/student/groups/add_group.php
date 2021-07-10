<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Groups */

$this->title = Yii::t('app', 'Create Groups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['student/student_groups']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <?= $this->render('add_group_form', [
        'model' => $model,'student_programme' => $student_programme
    ]) ?>

</div>
