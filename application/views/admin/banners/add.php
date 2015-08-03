<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/banners/add" method="post" enctype="multipart/form-data">  

	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Template</label>
		<div class="col-xs-12 col-sm-5">
			<select name="template" id="template" class="form-control required">
				<option value="" selected="selected">Select Template</option>
				<option value="personal" >Personal</option>
				<option value="twist">Twist</option>
				<option value="3apps">3apps</option>
				<option value="face_test">Face Test</option>
				<option value="how_old">How Old</option>
				<option value="facebook_apps">Facebook Apps</option>
				<option value="video">Video</option>
				<option value="ariticle">Ariticle</option>
				<option value="list">List</option>
				
			</select>			
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Title</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control required" id="title" name="title" value="">				
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Url</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control required" id="url" name="url" value="">				
		</div>				
	</div>
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Brand Title</label>
		<div class="col-xs-12 col-sm-5">
			<input type="text" class="form-control required" id="brand_title" name="brand_title" value="">				
		</div>				
	</div>
	
	<div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Image</label>
		<div class="col-xs-12 col-sm-5">
			<input class="required" type="file" name="image" />
		</div>				
	</div>
		
	  <div class="col-md-offset-3 col-sm-offset-3">
			<input type="hidden" name="add_banner" value="add_banner" />
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