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

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/site_config/list_config" method="post" enctype="multipart/form-data">  

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense List Top</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="test_top_adsense" id="test_top_adsense" class="form-control" rows="6"><?php if(isset($config_info->test_top_adsense)) echo $config_info->test_top_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense List Middle</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="test_middle_adsense" id="test_middle_adsense" class="form-control" rows="6"><?php if(isset($config_info->test_middle_adsense)) echo $config_info->test_middle_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense List Middle 2</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="test_middle_adsense2" id="test_middle_adsense2" class="form-control" rows="6"><?php if(isset($config_info->test_middle_adsense2)) echo $config_info->test_middle_adsense2;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense List Bottom</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="test_bottom_adsense" id="test_bottom_adsense" class="form-control" rows="6"><?php if(isset($config_info->test_bottom_adsense)) echo $config_info->test_bottom_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">List Sky Left Adsense</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="test_sky_left_adsense" id="test_sky_left_adsense" class="form-control" rows="6"><?php if(isset($config_info->test_sky_left_adsense)) echo $config_info->test_sky_left_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">List Sky Right Adsense </label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="test_sky_right_adsense" id="test_sky_right_adsense" class="form-control" rows="6"><?php if(isset($config_info->test_sky_right_adsense)) echo $config_info->test_sky_right_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		
		
		
		
		
		
		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="edit_config" value="edit_config" />

           		 <button type="submit" class="btn btn-primary">Save </button>  

				 

          </div> 


</form>  











<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready











</script>