<?php

if($this->session->flashdata('success_message'))

{

?>

	<div class="alert alert-success">  

	  <a class="close" data-dismiss="alert">x</a>  

	  <strong>Success!</strong><?php echo $this->session->flashdata('success_message');?>  

	</div> 

<?php

}



?>
<div class="form-group">
	<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right" style="text-align:right; margin-top:7px;">Languages</label>
	<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
			<select name="language" id="language" class="form-control">
				<option value="" >Select Language</option>
				<?php
					if($language_list)
					{
						foreach($language_list as $row)
						{
						?>
						<option value="<?php echo $row->language_code; ?>" <?php if($row->language_code == $lang) echo 'selected';?>><?php echo $row->language_name; ?></option>
						<?php 
						}
					}
				?>
			</select>  					
		</span>
	</div>				
</div>



<div style="clear:both; height:30px;"></div>
<div id="config_container">
	<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/site_config/language_config" method="post" enctype="multipart/form-data">  
		
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Domain/App Name</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control required" id="app_name" name="app_name" value="<?php echo $config_info->app_name;?>">  					
					</span>
				</div>				
			</div>
		
			<div class="form-group">
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Site Title</label>
				<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control required" id="site_title" name="site_title" value="<?php echo $config_info->site_title;?>">  					
					</span>
				</div>				
			</div>
			
			<div class="form-group">
				<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Page Description</label>
				
				<div class="col-xs-12 col-sm-5">
					
					<span class="block input-icon input-icon-right">
	
						<textarea name="page_description" id="page_description" class="form-control" rows="6"><?php echo $config_info->page_description;?></textarea> 					
	
					</span>
				</div>.
			</div>
	
			
	
			 <div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Facebook Url</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">
	
						<input type="text" class="form-control required" id="facebook_url" name="facebook_url" value="<?php echo $config_info->facebook_url;?>"> 					
	
					</span>
	
				</div>				
	
			</div>
	
			
	
			<div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Facebook AppID</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">
	
						<input type="text" class="form-control required" id="facebook_appid" name="facebook_appid" value="<?php echo $config_info->facebook_appid;?>"> 					
	
					</span>
	
				</div>				
	
			</div>
	
			
	
			 <div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Share Description</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">
	
						<textarea name="share_des" id="share_des" class="form-control" rows="6"><?php echo $config_info->share_des;?></textarea>					
	
					</span>
	
				</div>				
	
			</div>
	
			
	
	
	
			
	
			
	
			
	
			<div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Google Analytics</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">
	
						<textarea name="google_analytics" id="google_analytics" class="form-control" rows="6"><?php echo $config_info->google_analytics;?></textarea>					
	
					</span>
	
				</div>				
	
			</div>
	
			<div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Meta Image</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">					
	
						<input type="file" name="meta_img" id="meta_img" value="" />	
	
						<?php if($config_info->meta_img) { ?>	
	
							<img src="<?php echo base_url(); ?>assets/img/meta_img/<?php echo $config_info->meta_img; ?>" style="height:150px; width:200px;" />	
	
							<input type="hidden" name="pre_img_path" value="assets/img/meta_img/<?php echo $config_info->meta_img; ?>" />
	
						<?php } ?>			
	
					</span>
	
				</div>				
	
			</div>
			
			<div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Logo</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">					
	
						<input type="file" name="logo" id="logo" value="" />	
	
						<?php if($config_info->logo) { ?>	
	
							<img src="<?php echo base_url(); ?>assets/img/<?php echo $config_info->logo; ?>" style="height:100px;" />	
	
							<input type="hidden" name="pre_logo_path" value="assets/img/<?php echo $config_info->logo; ?>" />
	
						<?php } ?>			
	
					</span>
	
				</div>				
	
			</div>
			
			<div class="form-group">
	
				<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Favicon Icon</label>
	
				<div class="col-xs-12 col-sm-5">
	
					<span class="block input-icon input-icon-right">					
	
						<input type="file" name="favicon" id="favicon" value="" />	
	
						<?php if($config_info->favicon) { ?>	
	
							<img src="<?php echo base_url(); ?>assets/img/<?php echo $config_info->favicon; ?>" />	
	
							<input type="hidden" name="pre_favicon_path" value="assets/img/<?php echo $config_info->favicon; ?>" />
	
						<?php } ?>			
	
					</span>
	
				</div>				
	
			</div>
	
			
	
			
	
			  <div class="col-md-offset-3 col-sm-offset-3">
	
					<input type="hidden" name="edit_config" value="edit_config" />
					<input type="hidden" name="language" value="<?php echo $lang; ?>"  />
					 <button type="submit" class="btn btn-primary">Save </button>  
			  </div> 
	
		
	
	
	
	</form>  
</div>










<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {

	jQuery('#add_form').validate({});
	
	
	
	$(document).on('change','#language',function(e) {
		var language=$(this).val();
		window.location="<?php echo site_url();?>admin/site_config/index/"+language;
				
	});
	
}); // end document.ready











</script>