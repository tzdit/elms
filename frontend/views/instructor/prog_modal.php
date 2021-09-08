<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;




?>
<!-- <div class="col-md-6">
        </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
      </div>
              -->


<div class="modal fade" id="createProgramModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <span class="modal-title" id="exampleModalLabel"><h4>Create New Program</h4></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/instructor/create-program', 'enctype'=>'multipart/form-data']])?>
        <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'prog_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Program Name'])->label(false)?>
        </div> 
        </div>

        <div class="row">
        <div class="col-md-4">
        <?= $form->field($model, 'prog_duration')->textInput(['type'=>'number', 'min'=>0, 'max'=>1000, 'class'=>'form-control form-control-sm', 'placeholder'=>'Program Duration'])->label(false)?>
        
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'capacity')->textInput(['type'=>'number', 'min'=>0, 'max'=>1000, 'class'=>'form-control form-control-sm', 'placeholder'=>'Program Capacity'])->label(false)?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'programCode')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Program Code'])->label(false)?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <?= $form->field($model, 'department')->dropdownList($departments, ['prompt'=>'--Select Department--'], ['class'=>'form-control form-control-sm'])->label(false) ?>
        </div> 
        </div>

              
        <div class="row">
        <div class="col-md-12">
        <?= Html::submitButton('Submit', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
        <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
      
        </div>
        </div>
        <?php ActiveForm::end()?>
    </div>
    </div>
  </div>
</div>

<!-- table for program -->
<div class="body-content">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header p-2">
                <h3 class="card-title com-sm-12">
                  <i class="fas fa-list mr-1 text-info"></i>
                 List of Programs
                 
                </h3>
                
                <a href="#" class="btn btn-sm btn-primary btn-rounded float-right m-0 col-xs-12" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
              
              </div><!-- /.card-header -->
              <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="ProgramList" style="width:100%; font-family:'Time New Roman'; font-size:14px;">
            <thead>
            <tr><th width="1%">#</th><th>Program Code</th><th>Department</th><th>Program Name</th><th>Program Duration</th><th>Program Capacity</th><th width="15%">Action</th></tr>
            
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach($programs as $program): ?>
            <tr>
            <td><?= ++$i; ?></td>
            <td><?= $program->programCode ?></td>
            <td><?= $program->department->department_name ?></td>
            <td><?= $program->prog_name ?></td>
            <td><?= $program->prog_duration ?></td>
            <td><?= $program->capacity ?></td>
            <td>
             <?= Html::a('<i class="fas fa-edit"></i>',['updateprog', 'id'=>$program->programCode], ['class'=>'btn btn-info btn-sm m-0'])?>   
            <a href="#" class="btn btn-success btn-sm m-0"><i class="fas fa-eye"></i></a>
<<<<<<< HEAD
            <a href="#" class="btn btn-sm btn-danger float-right ml-2" data-toggle="modal" data-target="#modal-danger<?= $program -> programCode ?>"><span><i class="fas fa-trash"></i></span></a></td>
            </td>
            </tr>

            
            <div class="modal fade" id="modal-danger<?= $program -> programCode ?>">

<div class="modal-dialog">
  <div class="modal-content bg-danger">
    <div class="modal-header">
      <h4 class="modal-title">Deleting <b> <?= $program -> programCode ?> </b> Program</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <div class="modal-body">
    
      <p>Are you sure, you want to delete <b> <?= $program -> programCode ?> </b> Program&hellip;?</p>
      
    </div>
    <div class="modal-footer justify-content-between">
    
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      <?= Html::a('Delete', ['deleteprog', 'id'=>$program -> programCode], ['class'=>'btn btn-sm btn-danger float-right ml-2 btn-outline-light']) ?>
    </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

</div>
<!-- /.modal -->

=======
            <a href="#" class="btn btn-danger btn-sm m-0"><i class="fas fa-trash" ></i></a>
            </td>
            </tr>
>>>>>>> f59bbc439c3ad3342a28ca1a445f1173eb3fdadd
            <?php endforeach ?>
            </tbody>
            </table>
             
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>

      </div><!--/. container-fluid -->

    </div>
</div>
<?php 
$script = <<<JS
$(document).ready(function(){
  $("#ProgramList").DataTable({
    responsive:true
  });
  // alert("JS IS OKAY")
});
JS;
$this->registerJs($script);
?>