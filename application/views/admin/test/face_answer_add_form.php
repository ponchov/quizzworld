<h3 class="text-center col-sm-10" style="color:#0000FF; font-size:28px; margin-bottom:25px;">Answers For <?php echo $this->test_model->addOrdinalNumberSuffix($question_num);?>  Question </h3>

<div style="clear:both;"></div>

<?php

	$marks=array(-1,0,1);

	shuffle($marks);

?>

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/add_answer_face/<?php echo $test_id;?>/<?php echo $question_num;?>/<?php echo $test_question_id; ?>" method="post" >  

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-2 control-label no-padding-right">Answere 1</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

						

					<input type="text" class="form-control required" id="answere" name="answere" value="">					

				</span>

			</div>	

			<label for="inputInfo" class="col-xs-12 col-sm-1 control-label no-padding-right">Marks</label>	

			<div class="col-xs-12 col-sm-3" style="line-height:35px;">

				<?php echo $marks[0];?>

				<span class="block input-icon input-icon-right">					

					<input type="hidden" class="form-control required input-small" id="marks" name="marks" value="<?php echo $marks[0];?>">						

				</span>

			</div>		

		</div>

		

		

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-2 control-label no-padding-right">Answere 2</label>

			<div class="col-xs-12 col-sm-5">

				

				<span class="block input-icon input-icon-right">					

						

					<input type="text" class="form-control required" id="answere2" name="answere2" value="">					

				</span>

			</div>	

			<label for="inputInfo" class="col-xs-12 col-sm-1 control-label no-padding-right">Marks</label>	

			<div class="col-xs-12 col-sm-3" style="line-height:35px;">

				<?php echo $marks[1];?>

				<span class="block input-icon input-icon-right">					

					<input type="hidden" class="form-control required input-small" id="marks2" name="marks2" value="<?php echo $marks[1];?>">						

				</span>

			</div>		

		</div>

		

		

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-2 control-label no-padding-right">Answere 3</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">					

						

					<input type="text" class="form-control required" id="answere3" name="answere3" value="">					

				</span>

			</div>	

			<label for="inputInfo" class="col-xs-12 col-sm-1 control-label no-padding-right">Marks</label>	

			<div class="col-xs-12 col-sm-3" style="line-height:35px;">

				<?php echo $marks[2];?>

				<span class="block input-icon input-icon-right">					

					<input type="hidden" class="form-control required input-small" id="marks3" name="marks3" value="<?php echo $marks[2];?>">						

				</span>

			</div>		

		</div>

		

		

		

		

	          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_answer" value="add_answer" />

				<button type="submit" class="btn btn-success btn-lg col-sm-3"> Next </button> 

          </div>  



</form>  











<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {







	jQuery('#add_form').validate({});







}); // end document.ready











</script>