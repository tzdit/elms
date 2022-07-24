<?php  
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\Material;
use common\models\Submit;
use common\models\GroupAssignmentSubmit;
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\ClassRoomSecurity;

/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fas fa-book-reader'></i> ".(!empty($submits)?$submits[0]->ass->assName:"Failed students");
$this->title = !empty($submits[0]->ass->assName)?'Failed students '.$submits[0]->ass->assName:'Failed students';
$this->params['breadcrumbs'] = [
  ['label'=>'class Assignments', 'url'=>Url::to(['/instructor/class-assignments', 'cid'=>ClassRoomSecurity::encrypt($cid)])],
  ['label'=>$this->title]
];

?>
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
		<div class="inside_form_buttons float-right">
			
           
            
	    </div>

            <hr>

			
				<div class="clear">	</div>

				

				<div class="clear"></div>

	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-ex2">
		<thead>
			<tr>
				

				
				<th>
                <?php if(!empty($submits[0]) &&  $submits[0] instanceof Submit){;?>
					Registration no
					<?php }else{ ?>
						Group name
						<?php } ?>
				</th>

				<th>
					Score
				</th>
                <th>
					Comment
				</th>
				<th>
					Remark
				</th> 
				
			</tr>
		</thead>
	<tbody>
								<?php foreach ($submits as $submit) : ?>
                                    <?php if($submit->isFailed()){?>
						 			<tr>
									 	<td><?php 
										 if($submit instanceof Submit)
										 { 
										 print $submit->reg_no; 
										 }
										 else
										 {
										 print $submit->group->groupName;  
										 }
										 ?></td> 
										 <td><?= $submit->score; ?></td>
                                         <td><?= $submit->comment; ?></td>
                                         <td><?= Html::a('<i class="fa fa-edit" style="font-size:18px"></i>', ['mark-secure-redirect','id'=>$submit->ass->assID,'subid'=>$submit->submitID]) ?></td>
						 			</tr>
						 		     <?php } ?>
									 <?php endforeach ?>
		
			

	</tbody>
		</table>
					
					
				</div>

	<?php 	
	$script=<<<JS
    $(document).ready(function() {
    //$('#dataTables-ex2').DataTable();
    $("#dataTables-ex2").DataTable({
    	dom: 'Bfrtip',
         buttons: ['csv','pdf','excel','print']
    });
    // $("#MarkedStudents").DataTable({
    // 	dom: 'Bfrtip',
    //      buttons: [
    //      {extend:  'excel',
    //  		title: 'Marked students',
    //  		exportOptions: {columns: ':not(:eq(5))'},
    //  		text: 'Export to Excel',
    //  		className: 'btn btn-primary btn-sm'
    //  		},

    //    ]
    // });
       $("#duplicateStudents").DataTable();
    //remember the previous active tab logic
    //get the current active tab
   
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

        localStorage.setItem('activeTab', $(e.target).attr('href'));

    });

    var activeTab = localStorage.getItem('activeTab');

    if(activeTab){
  
        $('#tabs a[href="' + activeTab + '"]').tab('show');

    }
})

JS;

 $this->registerJs($script);

 ?>



