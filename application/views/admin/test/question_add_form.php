<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/add_question/<?php echo $test_id; ?>/<?php echo $lan; ?>" method="post" enctype="multipart/form-data" >  
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
		
	          <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="add_question" value="add_question" />
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