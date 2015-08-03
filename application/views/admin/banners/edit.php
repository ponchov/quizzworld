<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/banners/edit/<?php echo $banner_info->banner_id; ?>" method="post" enctype="multipart/form-data">  
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Template</label>
		<div class="col-xs-12 col-sm-5">
			<select name="template" id="template" class="form-control required">
				<option value="" selected="selected">Select Template</option>
				<option value="personal" <?php if($banner_info->template == "personal") echo "selected"; ?>>Personal</option>
				<option value="twist" <?php if($banner_info->template == "twist") echo "selected"; ?>>Twist</option>
				<option value="3apps" <?php if($banner_info->template == "3apps") echo "selected"; ?>>3apps</option>
				<option value="face_test" <?php if($banner_info->template == "face_test") echo "selected"; ?>>Face Test</option>
				<option value="how_old" <?php if($banner_info->template == "face_test") echo "selected"; ?>>How Old</option>
				<option value="facebook_apps" <?php if($banner_info->template == "facebook_apps") echo "selected"; ?>>Facebook Apps</option>
				<option value="video" <?php if($banner_info->template == "video") echo "selected"; ?>>Video</option>
				<option value="ariticle" <?php if($banner_info->template == "ariticle") echo "selected"; ?>>Ariticle</option>
				<option value="list" <?php if($banner_info->template == "list") echo "selected"; ?>>List</option>
				
			</select>			
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Title</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control required" id="title" name="title" value="<?php echo $banner_info->title; ?>">				
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Url</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control required" id="url" name="url" value="<?php echo $banner_info->url; ?>">				
		</div>				
	</div>
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Brand Title</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control required" id="brand_title" name="brand_title" value="<?php echo $banner_info->brand_title; ?>">				
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Status</label>
		<div class="col-xs-12 col-sm-5">
			<select name="status" class="form-control">
				<option value="1" <?php if($banner_info->status == 1) echo "selected" ?>>Active</option> 
				<option value="0" <?php if($banner_info->status == 0) echo "selected" ?>>Inactive</option>
			</select>				
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Image</label>
		<div class="col-xs-12 col-sm-5">
			<input  type="file" name="image" />
			<div style="padding-top:5px;">
				<?php
					if($banner_info->image)
					{
					?>
						<img src="<?php echo base_url(); ?><?php echo $banner_info->image; ?>"  />
					<?php 
					}
				?>	
			</div>	
		</div>	
			
	</div>

		
	  <div class="col-md-offset-3 col-sm-offset-3">
			<input type="hidden" name="edit_banner" value="edit_banner" />
			<input type="hidden" name="pre_image" value="<?php echo $banner_info->image; ?>"  />
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