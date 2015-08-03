<form class="form-horizontal" id="add_form" action="<?php echo site_url();?>admin/tests/add_result_option/<?php echo $test_info->tests_id;?>/<?php echo $lang_code; ?>" method="post" enctype="multipart/form-data">  



		    

		 <div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval From</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="interval_from" name="interval_from" value="">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Interval To</label>

			<div class="col-xs-12 col-sm-2 col-md-2">

				<span class="block input-icon input-icon-right">

					<input type="text" class="form-control required" id="interval_to" name="interval_to" value="">					

				</span>

			</div>				

		</div>

		

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="hidden" name="test_id" id="test_id" value="<?php echo $test_id;?>" />

					<input type="text" class="form-control required" id="result" name="result" value="">					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Result Description</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<textarea class="form-control" name="result_description" id="result_description"></textarea>					

				</span>

			</div>				

		</div>

		

		<div class="form-group">

			<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Image Upload</label>

			<div class="col-xs-12 col-sm-5">

				<span class="block input-icon input-icon-right">

					<input type="file" name="test_result_img"  />					

				</span>

			</div>				

		</div>

		

		



		

		

		

		



		  <div class="col-md-offset-3 col-sm-offset-3">

				<input type="hidden" name="add_result_option" value="add_result_option" />

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