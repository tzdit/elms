<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Update Student';
$this->params['courseTitle']='<i class="fa fa-edit"></i> Update Student' ;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['student-list']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-index">

    

<div class="body-content">
<div class="card-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


    </div>
    </div>
    </div>
