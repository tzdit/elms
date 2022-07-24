<?php

use common\models\Course;
use common\models\GroupAssignment;
use common\models\GroupGenerationAssignment;
use common\models\Groups;
use common\models\Student;
use common\models\StudentGroup;
use frontend\models\ClassRoomSecurity;
use frontend\models\GroupAssSubmit;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use common\models\SystemModules;




?>


        <!-- Content Wrapper. Contains page content -->
  <div class="modal fade" id="modulemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    
    <div class="modal-content">
    <div class="modal-header p-2"><div class="modal-title text-primary pl-3 text-sm"><i class="fa fa-plus-circle"></i> Add Module</div></div>
      <div class="modal-body">
        <div class="container-fluid pt-1">
        <?php $model=new SystemModules;$form = ActiveForm::begin(["method"=>"post","action"=>"/admin/add-module"])?>
    
                 <?= $form->field($model, 'moduleName')->textInput(['class'=>'form-control','placeholder'=>'Module Name'])->label(false) ?>
                 <?= $form->field($model, 'moduleDescription')->textInput(['class'=>'form-control','placeholder'=>'Module Description'])->label(false) ?>
                 <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class'=>'btn btn-default btn-sm float-right mr-0 text-primary']) ?>
                  </div>
                  </div>
                  </div>

                  <?php ActiveForm::end() ?>
               </div>
               
               </div>

        
     
    </div>
    </div>
     
     </div>


<?php
$script = <<<JS
$(document).ready(function(){
 
  $(document).on('click', '.migbutton', function(d){
              
                  d.preventDefault();
              
                  if($('.deletefilesx').is(':checked')){
                    Swal.fire({
                title: 'Migrate Forwards with Deleting Files ?',
                text: "You won't be able to revert this! And you won't be able to recover deleted files even if you migrate backwards !",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Migrate Anyways'
                }).then((result) => {
                if (result.isConfirmed) {

                $.ajax({
                    url:'/admin/migrate-forwards',
                    method:'post',
                    async:false,
                    dataType:'JSON',
                    data:$('#form').serialize(),
                    success:function(data){
                    if(data.forwarded){
                        Swal.fire(
                            'Forwarding successful !',
                            data.forwarded,
                            'success'
                )
                setTimeout(function(){
                    window.location.reload();
                }, 100);


                    }
                    else
                    {
                        Swal.fire(
                            'Forwarding Failed!',
                            data.failure,
                            'error'
                )
                setTimeout(function(){
                    window.location.reload();
                }, 100);

                    }
                    }
                })

                }
                })
              }
              else
              {
                $.ajax({
                    url:'/admin/migrate-forwards',
                    method:'post',
                    async:false,
                    dataType:'JSON',
                    data:$('#form').serialize(),
                    success:function(data){
                    if(data.forwarded){
                        Swal.fire(
                            'Forwarding successful !',
                            data.forwarded,
                            'success'
                )
                setTimeout(function(){
                    window.location.reload();
                }, 100);


                    }
                    else
                    {
                        Swal.fire(
                            'Forwarding Failed!',
                            data.failure,
                            'error'
                )
                setTimeout(function(){
                    window.location.reload();
                }, 100);

                    }
                    }
                })
              }

    })   


});

JS;
$this->registerJs($script);
?>
<?php 
$this->registerCssFile('@web/plugins/select2/css/select2.min.css');
$this->registerJsFile(
  '@web/plugins/select2/js/select2.full.js',
  ['depends' => 'yii\web\JqueryAsset']
);
$this->registerJsFile(
  '@web/js/create-assignment.js',
  ['depends' => 'yii\web\JqueryAsset'],

);



?>




