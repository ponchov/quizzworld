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

<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/site_config/knowledge_ad_config" method="post" enctype="multipart/form-data">  

		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Knowledge Top</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="adsense_knowledge_top" id="adsense_knowledge_top" class="form-control" rows="6"><?php echo $config_info->test_top_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Knowledge Middle</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="adsense_knowledge_middle" id="adsense_knowledge_middle" class="form-control" rows="6"><?php echo $config_info->test_middle_adsense;?></textarea>					
				</span>
			</div>				
		</div>
		
		<div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">AdSense Knowledge Bottom</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<textarea name="adsense_knowledge_bottom" id="adsense_knowledge_bottom" class="form-control" rows="6"><?php echo $config_info->test_bottom_adsense;?></textarea>					
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