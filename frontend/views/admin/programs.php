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

$this->params['courseTitle']="<i class='fa fa-graduation-cap'></i> Programs";
$this->title="Programs";
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];
?>
 




<div class="row">
          <div class="col-sm-12">
       
             
            <table width="100%" class="table table-striped table-bordered table-hover" id="programtable" style="font-size:12px">
		<thead>
			<tr>
				<th>
					Program Code
				</th>
        <th>
         Program Name
				</th>
				<th>
				Department
				</th>
        <th>
			    College
				</th>
      
				<th>
					Program Duration
				</th>
			
		
				
			
				
			</tr>
		</thead>
		<tbody>
								<?php foreach ($programs as $program) : ?>
						 			<tr>
									 	<td><?=  $program->programCode; ?></td>
                     <td><?=  $program->prog_name; ?></td>
                    <td><?=  $program->department->depart_abbrev; ?></td>
                    <td><?=  $program->department->college->college_abbrev; ?></td>
                    <td><?=  $program->prog_duration; ?></td>
                    
               
										
										


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
    dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Programs list'
            },
            {
                extend: 'excelHtml5',
                title: 'Programs list'
            },
            'print',
        ]
  });
  
 
 



})

//Deleting Program 
$(document).on('click', '.programdel', function(){
var programid = $(this).attr('progid');
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
      url:'/instructor/deleteprog',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{programid:programid },
      success:function(data){
        if(data.message){
          Swal.fire(
              'Deleted!',
              data.message,
              'success'
    )
    setTimeout(function(){
      window.location.reload();
    },100);
   

        }
      }
    })
   
  }
})

})




JS;
$this->registerJs($script);
?>