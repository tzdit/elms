<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\StudentCourse;
use common\models\Submit;
use common\models\Program;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\CreateProgram;


?>
 




<div class="row">
          <div class="col-md-6">
            </div>
            <div class="col-md-6">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#createProgramModal" data-toggle="modal"><i class="fas fa-plus" ></i>Create Program</a>
            </div>
            </div>
             
            <table width="100%" class="table table-striped table-bordered table-hover" id="programtable" style="font-size:12px">
		<thead>
			<tr>
				<th>
					Program Code
				</th>

				<th>
				Department Name
				</th>
       <th>
       Program Name
				</th>
				<th>
					Program Duration
				</th>
				<th>
				Program Capacity
				</th>
				<!-- <th>
					Question
				</th> -->
				
				<th width="15%">
					Action
				</th>
				<!-- <th>
					Grading
				</th> -->
				
			</tr>
		</thead>
		<tbody>
								<?php foreach ($programs as $program) : ?>
						 			<tr>
									 	<td><?=  $program->programCode; ?></td>
                    <td><?=  $program->department->department_name; ?></td>
                    <td><?=  $program->prog_name; ?></td>
                    <td><?=  $program->prog_duration; ?></td>
                    <td><?=  $program->capacity; ?></td>
                    <td><?= Html::a('<i class="fas fa-edit" style="font-size:18px"></i>',['updateprog', 'id'=>$program->programCode], ['class'=>'btn btn-sm btn-warning float-right ml-2']) ?>
                    <i class="fa fa-trash-alt" style="font-size:18px;color:red"></i></td>
                    
									
										
										


						 			</tr>
						 		
									 <?php endforeach ?>
		
			

		</tbody>
		</table>
    </div>
    </div>
</div>

<!--  ###################################render model to create_material ####################################################-->


<?php 
$script = <<<JS
$(document).ready(function(){
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  $("#programtable").DataTable({
    responsive:true,
  });
  
 
 

      Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Drop it!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/dropcourse',
      method:'post',
      async:false,
      dataType:'JSON',
      data:{ccode:ccode},
      success:function(data){
        if(data.message){
          Swal.fire(
              'Droped!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    }, 1500);
   

        }
      }
    })
   
  }
})

})



JS;
$this->registerJs($script);
?>