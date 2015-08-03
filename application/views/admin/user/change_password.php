<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/users/change_password" method="post" enctype="multipart/form-data">  
	
		<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right" style="color:#FF0000;">
						<?php echo validation_errors(); ?>					
					</span>
				</div>				
			</div>
		  <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Old Password</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="password" class="form-control required" id="old_password" name="old_password" value="">					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">New Password</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="password" class="form-control required" id="new_password" name="new_password" value="">					
				</span>
			</div>				
		</div>
		
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Confirm Password</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">	
					<input type="password" class="form-control required" id="confirm_password" name="confirm_password" value="">				
				</span>
			</div>				
		</div>
		
				
          <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="change_password" value="change_password" />
				<button type="submit" class="btn btn-primary">Save </button> 
				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  
          </div>  
		  
		  
		  
    

</form>  





<script language="javascript">

	

// REGISTRATION FORM VALIDATION (THE SHORTER FORM)

jQuery(document).ready(function () {

	jQuery('#add_form').validate({
		rules: {
				password: "",
				confirm_password: {
				  equalTo: "#new_password"
				}
			  }
	});

}); // end document.ready





</script>