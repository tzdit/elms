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
$this->params['courseTitle'] ="<i class='fa fa-pen texxt-info'></i> Quiz Scores";
$this->title ="Quiz Scores";
$this->params['breadcrumbs'] = [
  ['label'=>$cid.' Quizes', 'url'=>Url::to(['class-quizes','cid'=>ClassRoomSecurity::encrypt(yii::$app->session->get("ccode"))])],
  ['label'=>$this->title]
];

?>
 

<div class="site-index">
    <div class="body-content ">
            <!-- Content Wrapper. Contains page content -->
   
       <div class="container-fluid">
      

       
     <?php 
  

     //participating programs

       
       
       ?>
        
            <div class="container table-responsive">
            <table  class="table table-striped table-bordered table-hover text-sm " id="studenttable" >
		<thead>
			<tr>
       <th>
       S/no
				</th>
				<th>
				Registration Number
				</th>
        <th>
			   Score
				</th>
			</tr>
		</thead>
		<tbody>
								<?php foreach($scores as $index=>$score){?>
                  
                    <tr id=<?=$score->reg_no?> >
                    <td><?=$index+1?></td>
									 	<td><?=Html::encode($score->reg_no);?></td>
                    <td><?=Html::encode($score->score); ?></td>
                   
                   
                    
                    
						 			</tr>
						 		
									 <?php } ?>
		
			

		</tbody>
		</table>
                </div>
    </div>
    </div>
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
    dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Students\' Quiz Scores'
            },
            {
                extend: 'excelHtml5',
                title: 'Students\' Quiz Scores'
            },
            'print',
        ]
  });
  //$("#studenttable").DataTable({
    //responsive:true,
  //});
  
  $('#studenttable').DataTable({
    responsive:true,
    dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Students\' Quiz Scores'
            },
            {
                extend: 'excelHtml5',
                title: 'Students\' Quiz Scores'
            },
            'print',
        ]
  } );
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
