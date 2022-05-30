<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['courseTitle']="<i class='far fa-building'></i> Departments";
$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <div>
        <a href="#" class="btn btn-default btn-sm btn-rounded float-right m-0 " data-target="#createDepartmentModal" data-toggle="modal"><i class="fa fa-plus-circle" > Add Department</i></a>
    </div>

    <table width="100%" class="table table-striped table-bordered table-hover" id="DepartmentTable" style="font-size:12px">
        <thead>
        <tr>
            <th>
                College
            </th>

            <th>
                Department Name
            </th>
            <th>
                Department Abbreviation
            </th>

            <!-- <th>
                Question
            </th> -->

            <th width="10%">
                Action
            </th>
            <!-- <th>
                Grading
            </th> -->

        </tr>
        </thead>
        <tbody>
        <?php foreach ($collegeDepartments as $departments) : ?>
            <tr>
                <td><?=  $departments->college->college_name; ?></td>
                <td><?=  $departments->department_name; ?></td>
                <td><?=  $departments->depart_abbrev; ?></td>
                <td>

                <?= Html::a('<i class="fas fa-edit"></i>',['update-dept', 'deptid'=>$departments->departmentID], ['class'=>'m-0'])?>                 
                <a href="#" class=' text-danger m-0 departmentdel'><i class="fas fa-trash"> </i></a></td>
            </tr>

<!--         edit model-->
            <div class="modal fade" id="editDepartmentModal<?= $departments->departmentID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <span class="modal-title" id="exampleModalLabel"><h4>Edit Department <?= $departments->departmentID; ?></h4></span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/departmentmanage/update-department', 'id'=>$departments->departmentID, 'enctype'=>'multipart/form-data']])?>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'department_name')->textInput(['class'=>'form-control form-control-sm', 'value'=> $departments->department_name])->label(false)?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <?= $form->field($model, 'depart_abbrev')->textInput(['class'=>'form-control form-control-sm', 'value'=>$departments->depart_abbrev])->label(false)?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <?= Html::submitButton('Update', ['class'=>'btn btn-primary btn-md float-right ml-2']) ?>
                                    <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                            <?php ActiveForm::end()?>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>



        </tbody>
    </table>

</div>
<div class="modal fade" id="createDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <span class="modal-title" id="exampleModalLabel"><i class="fa fa-plus-circle"></i> Add New Department</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['method'=>'post', 'action'=>['/departmentmanage/index', 'enctype'=>'multipart/form-data']])?>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'department_name')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Department Name'])->label(false)?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'depart_abbrev')->textInput(['class'=>'form-control form-control-sm', 'placeholder'=>'Department Abbreviation'])->label(false)?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class'=>'btn btn-default btn-md float-right ml-2']) ?>
                      

                    </div>
                </div>
                <?php ActiveForm::end()?>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<<JS
$(document).ready(function(){
  $("#DepartmentTable").DataTable({
    responsive:true,
  });
  });

//Deleting Department 
$(document).on('click', '.departmentdel', function(e){
    //e.preventDefault();
var departmentid = $(this).attr('deptsid');
Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Delete it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/departmentmanage/deletedepartment',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{deptsid:departmentid },
      success:function(data){
        if(data.message){
          Swal.fire(
              'Deleted!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    },1000);
   

        }
      }
    })
   
  }
})



})
  
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
