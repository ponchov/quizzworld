<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/add_answer/<?php echo $test_question_id; ?>/<?php echo $lan; ?>" method="post" enctype="multipart/form-data" >  

		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Answere</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">			
					<textarea name="answere" id="answere" class="form-control required"></textarea>					
				</span>
			</div>				
		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Marks</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="marks" name="marks" value="">	

					(Marks all time have to english)				

				</span>

			</div>				

		</div>

		

		

	          <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_answer" value="add_answer" />

				<button type="submit" class="btn btn-primary">Save </button> 

				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  

          </div>  



</form>  











<script language="javascript">
// REGISTRATION FORM VALIDATION (THE SHORTER FORM)
jQuery(document).ready(function () {

	jQuery('#add_form').validate({});

}); // end document.ready

</script>