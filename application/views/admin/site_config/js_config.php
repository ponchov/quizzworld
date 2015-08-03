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

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/site_config/js_config" method="post" enctype="multipart/form-data">  
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Google Analytics</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="google_analytics" id="google_analytics" class="form-control" rows="6"><?php echo $config_info->google_analytics;?></textarea> 					
				</span>
			</div>.
		</div>

		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">FB Pixel</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="fb_pixel" id="fb_pixel" class="form-control" rows="6"><?php echo $config_info->fb_pixel;?></textarea> 					
				</span>
			</div>.
		</div>
		
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Quantcast</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="quantcast" id="quantcast" class="form-control" rows="6"><?php echo $config_info->quantcast;?></textarea> 					
				</span>
			</div>.
		</div>
		
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Google Code for Remarketing</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="google_remarking" id="google_remarking" class="form-control" rows="6"><?php echo $config_info->google_remarking;?></textarea> 					
				</span>
			</div>.
		</div>
		
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Taboola code (in HEAD)</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="taboola_head" id="taboola_head" class="form-control" rows="6"><?php echo $config_info->taboola_head;?></textarea> 					
				</span>
			</div>.
		</div>
		
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Taboola code (in BODY)</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="taboola_body" id="taboola_body" class="form-control" rows="6"><?php echo $config_info->taboola_body;?></textarea> 					
				</span>
			</div>.
		</div>
		
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Google Survey Tag (in BODY)</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="google_survey" id="google_survey" class="form-control" rows="6"><?php echo $config_info->google_survey;?></textarea> 					
				</span>
			</div>.
		</div>
		
		<div class="form-group">
			<label for="page_description" class="control-label col-xs-12 col-sm-3 col-md-3 no-padding-right">Google+ tag</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="google_plus" id="google_plus" class="form-control" rows="6"><?php echo $config_info->google_plus;?></textarea> 					
				</span>
			</div>.
		</div>


		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="js_config" value="js_config" />
				<input type="hidden" name="id" value="<?php echo $config_info->id;?>" />
           		 <button type="submit" class="btn btn-primary">Save </button>  

				 

          </div> 

		



</form>  

<br /> <br /> <br />









<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({});



}); // end document.ready











</script>