<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/add/<?php echo $lan;?>" method="post" >  

		 <div class="form-group">
			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Add Type</label>
			<div class="col-xs-12 col-sm-5">
				<span class="block input-icon input-icon-right">					
						
					<select name="add_type" id="add_type"  class="form-control required">
						<option value="test_add">Personality Test</option>
						<option value="test_add_wizard">Personality Test By Wizard</option>
						<option value="real_test_add_wizard">Real Test</option>
						<option value="twist_test_add_wizard">Knowledge Test</option>
						<option value="apps_test_add_wizard">Name's Test</option>
						<option value="face_test">Face Test</option>
						<option value="facebook_apps">Facebook Apps</option>
					</select>				
				</span>
			</div>
		</div>
	          <div class="col-md-offset-4 col-sm-offset-4">

				<input type="hidden" name="add" value="add" />
				<button type="submit" class="btn btn-success btn-lg col-sm-3">Next </button> 
          </div>  



</form>  











<script language="javascript">



	



// REGISTRATION FORM VALIDATION (THE SHORTER FORM)



jQuery(document).ready(function () {







	jQuery('#add_form').validate({});







}); // end document.ready











</script>