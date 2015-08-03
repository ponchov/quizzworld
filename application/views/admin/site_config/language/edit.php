<form class="form-horizontal" id="add_form" action="<?php echo site_url(); ?>admin/site_config/language_translate/<?php echo $lang_id; ?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data">  
	  
	  <div class="form-group">
		<label for="inputInfo" class="col-xs-12 col-sm-3  control-label no-padding-right">Language Label</label>
		<div class="col-xs-12 col-sm-5">
			<?php if($english_lang_name) echo ucfirst($english_lang_name); ?>
			<span class="block input-icon input-icon-right">
				<input type="text" class="form-control required" id="label" name="label" value="<?php if($language_info) echo $language_info->label; ?>">					
			</span>
		</div>				
	</div>

	

	  <div class="col-md-offset-3 col-sm-offset-3">
			<input type="hidden" name="edit_lang" value="edit_lang" />
			<input type="hidden" name="language_info" value="<?php if($language_info) echo "1"; else echo "0"; ?>" />
			<input type="hidden" name="languageId" value="<?php if($language_info) echo $language_info->id; ?>"  />			
			<button type="submit" class="btn btn-primary">Save </button> 
			<button class="btn btn-danger" onclick="history.back()" type="button">Cancel</button>  
	  </div> 		

</form>  











<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {



	jQuery('#add_form').validate({

			rules: {

				email: {

					required: true,

					email:true

					}

				}

	});



}); // end document.ready











</script>