<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/flags/edit/<?php echo $flag_info->flag_id;?>" method="post" >  

		    
		  <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Category Name</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">
					<input type="text" class="form-control required" id="flag" name="flag" value="<?php echo $flag_info->flag;?>">  					
				</span>
			</div>				
		</div>
		


		  <div class="col-md-offset-3 col-sm-offset-3">
				<input type="hidden" name="edit_flag" value="edit_flag" />
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