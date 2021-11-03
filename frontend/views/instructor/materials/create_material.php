<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use frontend\models\UploadMaterial;
use yii\helpers\Url;
use common\models\Module;
?>
<?php 
$assmodel = new UploadMaterial();
$ccode=yii::$app->session->get('ccode');

$this->params['courseTitle'] =Module::findOne($moduleID)->moduleName;
$this->title =Module::findOne($moduleID)->moduleName;
$this->params['breadcrumbs'] = [
  ['label'=>'class materials', 'url'=>Url::to(['/instructor/class-materials', 'cid'=>$ccode])],
  ['label'=>'upload material']
];
?>
<div class="container col d-flex justify-content-center">
<div class="card" style="width:70%">
      <div class="card-header bg-primary">
        <span><h6>Upload New Material</h6></span>
      </div>
      <div class="card-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/upload-material', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'assTitle')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Material Title'])->label(false)?>
        </div> 
        </div>
        
      <div class="row">
        <div class="col-md-12">
        <?= $form->field($assmodel, 'assType')->dropdownList(['Videos'=>'Videos','Notes'=>'Notes'], ['class'=>'form-control form-control-sm', 'prompt'=>'--select--'])->label('Material Type')?>
        </div>
        
      </div>
      <div class="row">
      <div class="col-md-12">
      <div class="custom-file">
      <?= $form->field($assmodel, 'assFile')->fileInput(['class'=>'form-control form-control-sm custom-file-input', 'id'=>'customFile'])->label('Select File', ['class'=>'custom-file-label col-form-label-sm', 'for'=>'customFile'])?>
      </div>
      <?= $form->field($assmodel, 'moduleID')->hiddenInput(['class'=>'form-control form-control-sm','value'=>$moduleID])->label(false)?>
      </div>
        </div>
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Upload', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
  
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>
</div>
