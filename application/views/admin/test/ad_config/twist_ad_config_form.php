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

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/ads_edit/<?php echo $test_id;?>/<?php echo $lang; ?>" method="post" enctype="multipart/form-data">  

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Twist Top</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="twist_top" id="twist_top" class="form-control" rows="6"><?php echo $config_info->twist_top;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Twist Middle</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="twist_middle" id="twist_middle" class="form-control" rows="6"><?php echo $config_info->twist_middle;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Twist Bottom</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="twist_bottom" id="twist_bottom" class="form-control" rows="6"><?php echo $config_info->twist_bottom;?></textarea>					
				</span>
			</div>				
		</div>

				

		  <div class="col-md-offset-3 col-sm-offset-3">
				 <input type="hidden" name="edit_config" value="edit_config" />
				 <input type="hidden" name="twist_ads" value="twist_ads" />
           		 <button type="submit" class="btn btn-primary">Save </button>  
          </div> 


</form>  

<script language="javascript">

// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {
	jQuery('#add_form').validate({});

}); // end document.ready











</script>