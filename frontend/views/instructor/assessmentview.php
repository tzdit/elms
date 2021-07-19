<?php
   use yii\bootstrap4\Breadcrumbs;
   use yii\grid\GridView;
   use fedemotta\datatables\DataTables;
   use yii\helpers\Url;
   use yii\helpers\Html;
   use common\models\StudentExtAssess;
   use common\models\ExtAssess;
   use frontend\models\AddAssessRecord;


   
   $this->title = 'assessment';
   $cid=yii::$app->session->get('ccode');
   $this->params['breadcrumbs'] = [
     ['label'=>'assessments', 'url'=>Url::to(['/instructor/classwork', 'cid'=>$cid])],
     ['label'=>'view']
   ];

   $records=StudentExtAssess::find()->where(['assessID'=>$assid])->all();
   $assessment=ExtAssess::findOne($assid)->title;
   $this->params['courseTitle'] = $cid." ".$assessment;
   $no=0;
?>
<div id="container-fluid">
<div class="row">
            <div class="col-md-12">
            <a href="#" class="btn btn-sm btn-primary btn-rounded float-right mb-2" data-target="#addrecord" data-toggle="modal"><i class="fas fa-plus" ></i>Add a record</a>
            </div>
            </div>
            <div id="row">
               <div id="col-md-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="assesstable" style="font-size:12px">
		<thead>
			<tr>
				<th>
					S/no
				</th>

				<th>
				Registration number
				</th>
       <th>
       Score
				</th>
				<th>
				</th>
				<!-- <th>
					Grading
				</th> -->
				
			</tr>
		</thead>
		<tbody>
								<?php foreach ($records as $record) : ?>
						 			<tr>
									 	<td><?= ++$no ?></td>
                    <td><?=  $record->reg_no; ?></td>
                    <td><?=  $record->score; ?></td>
                    <td>
                    <?= Html::a('<i class="fa fa-edit float-right" style="font-size:18px"></i>', ['edit-ext-assrecord-view','recordid'=>$record->student_assess_id]) ?>
                    <?= Html::a('<i class="fa fa-trash float-right" style="font-size:18px"></i>', ['delete-ext-assrecord','recordid'=>$record->student_assess_id]) ?>
                    
                  </td>		
						  </tr>
						 		
									 <?php endforeach ?>
		
			

		</tbody>
		</table>
  
    </div>
    </div>


      </div>
      <?php 
$recmodel= new AddAssessRecord();
?>
<?= $this->render('addassrecord', ['assessmodel'=>$recmodel,'assessid'=>$assid]) ?>

<?php
  $script = <<<JS
  $('document').ready(function(){

  $('#assesstable').dataTable();


  })
  JS;
  $this->registerJs($script);
?>