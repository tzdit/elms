<?php

use kartik\file\FileInput;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\widgets\Alert;


AppAsset::register($this);



/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form ActiveForm */

$this->params['breadcrumbs'] = [
    ['label'=>'Group Assignment Submission', 'url'=>Url::to(Yii::$app->request->referrer)],
    ['label'=>$this->title]
];
?>
<div class="changePassword">


    <div class="container">
        <div class="card shadow-lg" style="font-family:'Times New Roman', sans-serif">
            <div class="card-header text-center bg-primary">
                <h2>Group Submit</h2>
            </div>
            <div class="card-body">
                <h3 class='text-muted'>Submit by uploading the file</h3>
                <h5 class='text-danger font-italic font-weight-bold'>Submit assignment and notify your member to avoid wrong submit</h5>
                <br>
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
