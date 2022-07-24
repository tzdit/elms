<style>
		li.answer input:checked{
			background: #00c4ff3d;
		}
</style>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary"><?php echo "Programming Quiz" ?> | <?php echo "5" .' Points Each Question' ?></div>
		<div class="col-md-12 alert alert-success">SCORE : <?php echo "5" .' / ' . "10" ?></div>
		<br>
		<div class="card">
			<div class="card-body">
					<input type="hidden" name="user_id" value="<?php echo "1" ?>">
					<input type="hidden" name="quiz_id" value="<?php echo "1" ?>">
					<input type="hidden" name="qpoints" value="<?php echo "10" ?>">
					

				<ul class="q-items list-group mt-4 mb-4 ?>">
					<li class="q-field list-group-item">
					    <?php echo $i=0; ?>
						<strong><?php echo ($i++). '. '; ?> <?php echo "1" ?></strong>
						<input type="hidden" name=" " value="">
						<br>
						<ul class='list-group mt-4 mb-4'>
							<li class="answer list-group-item <?php echo 1 == 1 && 1 == 1 ? "bg-success" : 0 == 1 ? "bg-success" : "bg-danger" ?>">
								<label><input type="radio" name="" value="" <?php echo 1== 1  ? "checked='checked'" : "" ?>> </label>
							</li>
						

						</ul>

					</li>
				</ul>
			</div>	
		</div>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('input').attr('readonly',true)
		
	})
</script>
</html>