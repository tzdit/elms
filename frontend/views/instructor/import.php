<?php  
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
?>

<?php



$model = new app\models\uploadForm();
$form = ActiveForm::begin([
  'id' => 'upload',
  'options' => ['enctype' => 'multipart/form-data'],
])
?>

<?= $form->field($model,'file')->fileInput(['multiple'=>'multiple']) ?>

  < button > upload
<?php ActiveForm::end() ?>