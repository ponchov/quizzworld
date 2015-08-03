<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/contact_user/contact_user_edit/<?php echo $contact_user_info->contact_us_user_id;?>" method="post" >  

		    

					
					<div class="form-group">
						<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name</label>
						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control required" id="name" name="name" value="<?php echo $contact_user_info->name;?>">					
							</span>
						</div>				
					</div>
					
					<div class="form-group">
						<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Email</label>
						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<input type="text" class="form-control required" id="email" name="email" value="<?php echo $contact_user_info->email;?>">					
							</span>
						</div>				
					</div>

					
					<div class="form-group">
						<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Comments</label>
						<div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
								<textarea name="comments" id="comments" class="form-control required"><?php echo $contact_user_info->comments;?></textarea>					
							</span>
						</div>				
					</div>
		
		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Status</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<select name="status" id="status" class="form-control">
					<option value="1" <?php if($contact_user_info->status == 1) echo "selected";?>>Active</option>
					<option value="0"  <?php if($contact_user_info->status == 0) echo "selected";?>>Inactive</option>
				  </select>					
				</span>
			</div>				
		</div>

		  <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="edit_contact_user" value="edit_contact_user" />
           		 <button type="submit" class="btn btn-primary">Save </button>  
				<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  
          </div> 
		

</form>  




<script language="javascript">
	jQuery(document).ready(function () {
		jQuery('#add_form').validate({
			rules: {
					email: {
						required: true,
						email:true
					}
					}
		});
	}); 
</script>
