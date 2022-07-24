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



/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form ActiveForm */
$this->params['courseTitle'] ='<img src="/img/Assignment4.png" height="30px" width="29px"/> '.yii::$app->session->get("ccode"). ' Assignment Submission';
$this->title ='Submit';
$this->params['breadcrumbs'] = [
    ['label'=>'Normal Assignments', 'url'=>Url::to(['/student/view-normal-assignments','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
    ['label'=>$this->title]
  ];
?>
<div class="changePassword">

   
        <div class="container">
                    <div class="card shadow-lg" style="font-family:'Times New Roman', sans-serif">
                        <div class="card-header text-center responsivetext bg-primary p-1">
                            <i class="fa fa-upload"></i> Submit Assignment 
                        </div>
                        <div class="card-body">
<!--                                        <div class="upload-icon">-->
<!--                                            <i class="fas fa-upload"></i>-->
<!--                                        </div>-->
<!---->
<!--                                        <br>-->
<!--                                        <span class='drag-header m-0'>Drag and drop file you want to upload</span>-->
<!--                                        <br>-->

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
