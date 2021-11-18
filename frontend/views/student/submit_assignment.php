<?php
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
    ['label'=>'Assignment Submission', 'url'=>Url::to(['/student/submit_assignment','assID'=> $assID])],
    ['label'=>$this->title]
  ];
?>
<div class="changePassword">

   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="card shadow-lg" style="font-family:'Times New Roman', sans-serif">
                        <div class="card-header text-center bg-primary">
                            <h2>Submit</h2>
                        </div>
                        <div class="card-body">
                            <div class="drop-over drop-zone">
                                <div class="row ">
                                    <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center">
                                        <p class='text-muted'>Submit by uploading the file</p>
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

                                        <div class="btn-primary btn-file px-3 py-1">
                                            Select File
                                            <input type="file" name="document" id="document-file" class="drop-zone-input">
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>


                                    <div class="form-group">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                </div>
            </div>
           
        </div>
    
    

</div><!-- changePassword -->
