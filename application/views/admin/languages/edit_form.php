<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/languages/edit/<?php echo $language_info->language_id;?>" method="post" >  

		   <div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right"></label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right" style="color:#FF0000;">
						<?php echo validation_errors(); ?>					
					</span>
				</div>				
			</div>
			
		  <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Language Name</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="language_name" name="language_name" value="<?php echo $language_info->language_name;?>">  					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Language Code</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="language_code" name="language_code" value="<?php echo $language_info->language_code;?>">					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Status</label>
			<div class="col-xs-12 col-sm-5">
				<select name="status" class="form-control">
					<option value="1" <?php if($language_info->status == 1) echo "selected"; ?>>Active</option>
					<option value="0" <?php if($language_info->status == 0) echo "selected"; ?>>Inactive</option>
				</select>
			</div>				
		</div>


		  <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="edit_language" value="edit_language" />
				<input type="hidden" name="language_id" value="<?php echo $language_info->language_id;?>"  />
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