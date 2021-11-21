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
use frontend\models\UploadAssignment;
use frontend\models\UploadTutorial;
use frontend\models\UploadLab;
use frontend\models\UploadMaterial;
use frontend\models\ClassRoomSecurity;
/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fas fa-book-reader'></i> ".Assignment::findOne(ClassRoomSecurity::decrypt($id))->assName." : Missing Assignments";
$this->title = "Missing Assignments";
$this->params['breadcrumbs'] = [
  ['label'=>'class Assignments', 'url'=>Url::to(['/instructor/class-assignments', 'cid'=>$cid])],
  ['label'=>$this->title]
];
?>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
		<div class="inside_form_buttons float-right">
			
           
            
	    </div>

            <hr>

				
			<?php 
           
            ?>
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-ex2">
		<thead>
			<tr>
				

				
				<th>
				 Reg No / Group Name
				</th>
				
			</tr>
		</thead>
		<tbody>
								<?php foreach ($missing as $miss) : ?>
						 			<tr>
									 	<td>
										 <?php 
									
										 print $miss
										
								
										 ?>
										</td>
									
										
									
										
										
										


						 			</tr>
						 		
									 <?php endforeach ?>
		
			

		</tbody>
		</table>
</div>
</div>

<?php	
  $this->registerJsFile(
	'@web/js/stdwork.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
	
	?>



