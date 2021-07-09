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
$this->params['courseTitle'] = "Submits";
$this->title = 'Submits';
$this->params['breadcrumbs'] = [
  ['label'=>'classwork', 'url'=>Url::to(['/instructor/stdwork', 'cid'=>$cid])],
  ['label'=>$this->title]
];
?>

<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid">
		<div class="inside_form_buttons float-right">
			
           
            
	    </div>

            <hr>

				
				
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
				<th>
					Actions
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
										 <td><?=  $submit->ass->assName; ?></td>
										 <td><?= $submit->fileName; ?></td>
										 <td><?= $submit->score; ?></td>
										 <td><?= $submit->submit_date; ?></td>
										 <td><?= $submit->submit_time; ?></td>
										 <td><?= $submit->comment; ?></td>
										 <td><i class="fa fa-pen"></i></td>
										
										


						 			</tr>
						 		
									 <?php endforeach ?>
		
			

		</tbody>
		</table>
</div>
</div>

<?php	
$this->registerJsFile(
	'@web/js/jquery.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
  $this->registerJsFile(
	'@web/js/datatables.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );	
$this->registerJsFile(
	'@web/js/tablesbutton.min.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
  $this->registerJsFile(
	'@web/js/jszip.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
  $this->registerJsFile(
	'@web/js/pdfmake.min.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
  $this->registerJsFile(
	'@web/js/vfs_fonts.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
$this->registerJsFile(
	'@web/js/buttons.html5.min.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
  $this->registerJsFile(
	'@web/js/buttons.print.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );

  $this->registerJsFile(
	'@web/js/print.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
 
  
 
  $this->registerJsFile(
	'@web/js/stdwork.js',
	['depends' => 'yii\web\JqueryAsset'],
  
  );
	
	?>



