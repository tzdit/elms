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
$this->params['courseTitle'] ="<i class='fa fa-user-friends'></i> ".$cid. " Partners";
$this->title = $cid. " Partners";
$this->params['breadcrumbs'] = [
  ['label'=>$cid.' dashboard', 'url'=>Url::to(['/instructor/class-dashboard', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
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
          <div class="card card-info card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
              
              </div>
             
              <div class="card-body" >
                <div class="row"><div class="col-md-12"><a href="#"  class="btn btn-sm btn-info float-right" data-target="#myModal<?=str_replace(" ","",yii::$app->session->get('ccode'))?>" data-toggle="modal"  ccode="<?= yii::$app->session->get('ccode') ?>" ><i class="fas fa-user-plus float-right" data-toggle="tooltip" data-title="Add New partner" > Add New </i></a></div></div>
     <?php 
  

     //participating programs

       
       
       ?>
        
            <div class="table-responsive mt-3">
            <table width="100%" class="table table-striped table-bordered table-hover text-sm " id="studenttable" style="width:100%">
		<thead>
			<tr>
       <th>
       Full name
				</th>
				<th>
					Gender
				</th>
				<th>
				College
				</th>
        <th>
			   Department
				</th>
      <th>
        Chat
      </th>
      <th>
        Action
      </th>
				
			</tr>
		</thead>
		<tbody>
								<?php foreach($partners as $partner){ $instructor=$partner->instructor;?>
                    <tr id=<?=$instructor->user->username?> >
									 	<td><?=Html::encode($instructor->full_name);?></td>
                    <td><?=Html::encode($instructor->gender); ?></td>
                    <td><?=Html::encode($instructor->department->college->college_abbrev); ?></td>
                    <td><?=Html::encode($instructor->department->depart_abbrev); ?></td>
                    <td id=<?=$instructor->userID?> class="contactelem" data-toggle="tooltip" data-title="Open Chat"><a href="#"><i class="fas fa-envelope mr-2"></i></a></td>
                    <td ><a href="#" id=<?=$instructor->instructorID?> class="partnerdel"><i class="fa fa-trash fa-1x text-danger" ></i></a></td>
                    
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
</div>
                </div>
                
    

<!--/////////////////////////-- add new partner -->


<?php 
          $instructorid=Yii::$app->user->identity->instructor->instructorID;
          $instructors=ArrayHelper::map(Instructor::find()->asArray()->where(['<>','instructorID',$instructorid])->all(),'instructorID','full_name');
          $partner = new AddPartner();
          ?>
          <?= $this->render('add_partner',['partners'=>$partner,'instructors'=>$instructors,'cid'=>yii::$app->session->get('ccode')]) ?>



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
  
  $('#studenttable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv',
            {
                extend: 'pdfHtml5',
                title: 'Class students list'
            },
            {
                extend: 'excelHtml5',
                title: 'Class students list'
            },
            'print',
        ]
    } );
$('.partnerdel').click(function(w){

 w.preventDefault();
var partner=$(this).attr('id');
  Swal.fire({
  text: "Remove this partner from this course",
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
