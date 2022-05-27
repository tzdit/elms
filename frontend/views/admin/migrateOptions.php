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




?>


        <!-- Content Wrapper. Contains page content -->
  <div class="modal fade" id="migrateOptionsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header bg-primary pt-2 pb-2">
        <span class="modal-title" id="exampleModalLabel"><h6><i class='fa fa-cog'></i> Migrate Options</h6></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid d-flex justify-content-center">
                 <form  method="post" action="/admin/migrate-forwards">

            
                  <span class="row p-2"><input type="checkbox" name="deletefiles" class="m-2 deletefilesx"/> Delete All Assignments submitted files</span>
                  <span class="row p-2"><input type="checkbox" name="openregistration" class="m-2"/> Open Student Registration</span>
                  <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                  <span class="float-right pt-5"><button type="submit"  class="btn btn-default btn-md shadow text-primary migbutton">Migrate <i class="fa fa-arrow-right"></i></button></span>
                  </div>
                  </div>
                  </div>

</form>
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




