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
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
?>
<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
		<div class="inside_form_buttons float-right">
			
           
            
	    </div>

            <hr>

			
				<div class="clear">	</div>

				

				<div class="clear"></div>
				<!-- TABS FOR submitted students, not submitted and graded -->
				<ul class="nav nav-tabs justify-content-center" id="tabs">
					<li class="nav-item">
						<a href="#turnedin" class="nav-link active" data-toggle="tab">Turned In</a>
					</li>
					<li class="nav-item">
						<a href="#assigned" class="nav-link" data-toggle="tab">Assigned</a>
					</li>
					<li class="nav-item">
						<a href="#marked" class="nav-link" data-toggle="tab">Marked</a>
					</li>
					
					
				</ul>
				<div class="tab-content mt-2">
					<div class="tab-pane container-fluid active" id="turnedin">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-ex2">
		<thead>
			<tr>
				

				
				<th>
					Registration no
				</th>

				<th>
					Assignment Name
				</th>

				<th>
					File Name
				</th>
				<th>
					Score
				</th>
				<!-- <th>
					Question
				</th> -->
				
				<th>
					Submit Date
				</th>

				<th>
					Submit Time
				</th>

				<th>
					Comment
				</th>
				
				<!-- <th>
					Grading
				</th> -->
				
			</tr>
		</thead>
		<tbody>
								<?php foreach ($submits as $submit) : ?>
						 			<tr>
									 	<td><?=  $submit->reg_no; ?></td>
										 <td><?=  $submit->ass->assName; ?></td>
										 <td><?= $submit->fileName; ?></td>
										 <td><?= $submit->score; ?></td>
										 <td><?= $submit->submit_date; ?></td>
										 <td><?= $submit->submit_time; ?></td>
										 <td><?= $submit->comment; ?></td>
										
										


						 			</tr>
						 		
									 <?php endforeach ?>
		
			

		</tbody>
		</table>
					</div>
					<div class="tab-pane container-fluid " id="assigned">
						<?php 
					
						?>
									

								</tbody>
							</table>
						
					</div>
					<div class="tab-pane container-fluid" id="marked">
						
						 
						 <table class="table table-striped table-bordered" id="MarkedStudents">
						 	<thead>
						 		<tr>
						 			<th>#</th><th>STUDENT NAME</th> <th>REG#</th><th>YOS</th><th>SCORE</th><th>Gradding</th>
						 		</tr>
						 	</thead>
						 	<tbody>
						 		<tr></tr>
						 	</tbody>
						 	
						 </table>
						

					</div>
					
				</div>

			
		<script>
    $(document).ready(function() {
    $('#dataTables-ex2').DataTable();
    // $("#AssignedStudents").DataTable({
    // 	dom: 'Bfrtip',
    //      buttons: [
    //      {
    //      	extend: 'excel',
    //      	message: 'Export To EXCEL',
    //      	title: 'Assigned Students'

    //      },
    //       {
    //      	extend: 'pdf',
    //      	title: 'Assigned Students in PDF'

    //      },
    //       {
    //             extend: 'csv',
    //             title: 'Assigned Students'
    //         },
    //      ]
    // });
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

} );
    </script>

<?php 
	/*if (isset($_POST['ggg'])) {
		$g = $_POST['grad'];
		$tt = $_POST['tat'];
		$idd =$_POST['idd'];
		if($g > $tt){
			?>
			<script type="text/javascript">alert("You Can not Put Marks > Total Marks");</script>
			<?php
		}elseif(!isset($g) || empty($g)){
			?>
			<script type="text/javascript">alert("Please Enter Marks First");</script>
			<?php
		}else{
			$stm = $conn->prepare("UPDATE `tbl_submit` SET result=:result,status=:status WHERE id=:id ");
			$stm->execute([':result'=>$g, ':status'=>'marked', ':id'=>$idd]);
			header('location: manage_my_course.php?id='.$cod);
		}
		
		//header('location: manage_my_course.php?id='.$cod);
	}

				*/

 ?>



