
	<?php
use yii\bootstrap4\Breadcrumbs;
use yii\grid\GridView;
use fedemotta\datatables\DataTables;
use common\models\Material;
use common\models\Instructor;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\Custom;
use common\helpers\Security;
use common\models\Assignment;
use common\models\Submit;
use common\models\GroupAssignmentSubmit;
use frontend\models\UploadMaterial;
use yii\helpers\VarDumper;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
$this->title = 'Quiz'; 
$this->params['breadcrumbs'][] = ['label' => 'Quiz', 'url' => ['student/quiz_answer']];
$this->params['breadcrumbs'][] = $this->title;
?>
	
	<style>
		li.answer{
			cursor: pointer;
		}
		li.answer:hover{
			background: #00c4ff3d;
		}
		li.answer input:checked{
			background: #00c4ff3d;
		}
	</style>
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary"><?php echo "Quiz Title"?> | <?php echo "5" .' Points Each Question' ?></div>
		<br>
		<div class="card">
			<div class="card-body">
				<form action="" id="answer-sheet">
					<input type="hidden" name="user_id" value="">
					<input type="hidden" name="quiz_id" value="">
					<input type="hidden" name="qpoints" value="">

				<ul class="q-items list-group mt-4 mb-4">
					<li class="q-field list-group-item">
						<input type="hidden" name=" " value=" ">
						<br>
						<ul class='list-group mt-4 mb-4'>
					

							<li class="answer list-group-item">
								<label><input type="radio" name="" value=""></label>
							</li>

						</ul>

					</li>
				</ul>

				<button class="btn btn-block btn-primary">Submit</button>
				</form>
			</div>	
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('.answer').each(function(){
		$(this).click(function(){
			$(this).find('input[type="radio"]').prop('checked',true)
			$(this).css('background','#00c4ff3d')
			$(this).siblings('li').css('background','white')
		})


		})
		$('#answer-sheet').submit(function(e){
			e.preventDefault()
			$('#answer-sheet [type="submit"]').attr('disabled',true)
			$('#answer-sheet [type="submit"]').html('Saving...')
			$.ajax({
				url:'submit_answer.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
					if(resp.status == 1){
						alert('You completed the quiz your score is '+resp.score)
						location.replace('view_answer.php')
					}
					}
				}
			})
		})
		
	})
</script>