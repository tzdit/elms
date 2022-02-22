<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\ClassRoomSecurity;
use common\models\Instructor;
use frontend\models\AddPartner;

/* @var $this yii\web\View */
$cid=yii::$app->session->get('ccode');
$this->params['courseTitle'] =$cid. " Classmates";
$this->title = $cid. " Classmates";
$this->params['breadcrumbs'] = [
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      
 <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 ">
       
     <?php 
  

     //participating programs

       
       
       ?>
        
            <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover text-sm " id="studenttable" style="width:100%">
		<thead>
			<tr>
       <th>
       Reg. No
				</th>
				<th>
				College
				</th>
        <th>
			   Department
				</th>
      <th>
        Program
      </th>
      <th>
        YOS
      </th>
      <th>
       
      </th>
				
			</tr>
		</thead>
		<tbody>
								<?php for($stud=0;$stud<count($classmates);$stud++){ $classmate=$classmates[$stud];if($classmate->reg_no==yii::$app->user->identity->student->reg_no){continue;}?>
                  
                    <tr id=<?=$classmate->reg_no?> >
									 	<td><?=Html::encode($classmate->reg_no);?></td>
                    <td><?=Html::encode($classmate->program->department->college->college_abbrev); ?></td>
                    <td><?=Html::encode($classmate->program->department->depart_abbrev); ?></td>
                    <td><?=Html::encode($classmate->programCode); ?></td>
                    <td><?=Html::encode($classmate->YOS); ?></td>
                    <td id=<?=$classmate->userID?> class="contactelem" data-toggle="tooltip" data-title="Open Chat"><a href="#"><i class="fas fa-envelope mr-2"></i></a></td>
                    
                    
						 			</tr>
						 		
									 <?php } ?>
		
			

		</tbody>
		</table>
                </div>
    </div>
    </div>
</div>

</section>
          
</div>

      </div><!--/. container-fluid -->

    </div>
</div>
</div>

                
    



<?php 
$script = <<<JS
$(document).ready(function(){
  $('#assignstudents').select2();
  $('#remstudents').select2();
  $(".headcard").on('show.bs.collapse','.collapse', function(e) {
  $(e.target).parent().addClass('shadow');
  });
  $(".headcard").on('hidden.bs.collapse','.collapse', function(e) {
  $(e.target).parent().removeClass('shadow');
  });
  $("#CoursesTable").DataTable({
    responsive:true,
  });
  //$("#studenttable").DataTable({
    //responsive:true,
  //});
  
  $('#studenttable').DataTable( );
$('.partnerdel').click(function(w){

 w.preventDefault();
var partner=$(this).attr('id');
  Swal.fire({
  text: "remove this partner from this course",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, remove!'
}).then((result) => {
  if (result.isConfirmed) {
 
    $.ajax({
      url:'/instructor/remove-partner',
      method:'get',
      async:false,
      dataType:'JSON',
      data:{partner:partner},
      success:function(data){
        if(data.message){
          Swal.fire(
              '',
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
})

JS;

$this->registerJs($script);

?>
