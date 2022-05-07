<?php

use kartik\file\FileInput;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\ClassRoomSecurity;


AppAsset::register($this);

$this->title="Submit";
$this->params['courseTitle']='<img src="/img/groupass.png" height="25px" width="25px"/> '.yii::$app->session->get("ccode").' Group Assignment Submit';
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form ActiveForm */

$this->params['breadcrumbs'] = [
    ['label'=>'Group Assignments', 'url'=>Url::to(['student-group','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
];
?>
<div class="changePassword">


    <div class="container">
        <div class="card shadow-lg" style="font-family:'Times New Roman', sans-serif">
            <div class="card-header text-center bg-primary p-1">
                <i class="fa fa-upload"></i> Submit Assignment
            </div>
            <div class="card-body">
     
                              

                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->errorSummary($model) ?>

                <div class="form-group">
                    <?=

                    FileInput::widget([
                        'model' => $model,
                        'attribute' => 'document',
                        'options' => ['multiple' => false],
                        'pluginOptions' => [
                            'showUpload' => true,
                            'browseLabel' => 'Browse to choose attachment',
                            'removeLabel' => 'Remove',
                            'uploadClass' => ' mx-2 btn btn-primary',
                            'browseClass' => 'btn btn-success',
                            'removeClass' => 'btn btn-danger',
                        ]

                    ]);

                    ?>

                </div>
                <?php ActiveForm::end(); ?>
            </div>


            <div class="form-group">

            </div>
        </div>


    </div>



</div><!-- changePassword -->
