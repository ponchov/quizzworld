<h3 class="text-center col-sm-10" style="color:#0000FF; font-size:28px; margin-bottom:25px;"><?php echo $this->test_model->addOrdinalNumberSuffix($question_num);?>  Question </h3>
<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/real_add_question_wizard/<?php echo $test_id; ?>/<?php echo $question_num ;?>" method="post" enctype="multipart/form-data" >  
		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Question</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
					<input type="text" class="form-control required" id="question" name="question" value="">						
				</span>
			</div>
							
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>
			<div class="col-xs-12 col-sm-5">
				<span style="color:#FF0000;">(Image should be 660x230) </span>
				<span class="block input-icon input-icon-right">					
					<input type="file" name="image" id="image" value="" />				
				</span>
			</div>				
		</div>
		
	          <div class="col-md-offset-4 col-sm-offset-4">
				<input type="hidden" name="add_question" value="add_question" />
				
				<button type="submit" class="btn btn-success btn-lg col-sm-3">Next </button> 
				<?php
					if($question_num > 3)
					{
						?>
							<?php /*?><a href="<?php echo site_url();?>admin/tests/add_wizard_result_option/<?php echo $test_id; ?>"><button style="margin:auto 10px;" type="button" class="btn btn-primary btn-lg col-sm-2">Add Result </button></a><?php */?> 
							<a href="<?php echo site_url();?>admin/tests/real_test_add_wizard"><button style="margin:auto 10px;" type="button" class="btn btn-primary btn-lg col-sm-2">Add New Test </button></a>
						<?php
					}
				?>
				
          </div>  

</form>  





<script language="javascript">

	

// REGISTRATION FORM VALIDATION (THE SHORTER FORM)

jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready





</script>