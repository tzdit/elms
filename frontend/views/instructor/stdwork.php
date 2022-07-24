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
/* @var $this yii\web\View */
$this->params['courseTitle'] ="<i class='fas fa-book-reader'></i> ".(!empty($submits)?$submits[0]->ass->assName." submits":"Assignment Submits");
$this->title = !empty($submits[0]->ass->assName)?$submits[0]->ass->assName." Submits":'Assignment Submits';
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

				
				
	<table width="100%" class="table table-striped table-bordered table-hover text-sm" id="dataTables-ex2">
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
					File Name
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
					Score
				</th>

				<th>
					Comment
				</th>
				<th>
					Mark/Remark
				</th>
				
				<!-- <th>
					Grading
				</th> -->
				
			</tr>
		</thead>
		<tbody>
								<?php foreach ($submits as $submit) : ?>
						 			<tr>
									 	<td>
										 <?php 
										 if($submit instanceof Submit)
										 { 
										 print $submit->reg_no; 
										 }
										 else
										 {
										 print $submit->group->groupName;  
										 }
										 ?>
										</td>
										 <td><?= $submit->fileName; ?></td>
										
										 <td><?= $submit->submit_date; ?></td>
										 <td><?= $submit->submit_time; ?></td>
										 <td><?= $submit->score; ?></td>
										 <td><?= $submit->comment; ?></td>
										 <td><?= Html::a('<i class="fa fa-edit" style="font-size:18px"></i>', ['mark-secure-redirect','id'=>$submit->ass->assID,'subid'=>$submit->submitID]) ?></td>
										
										


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



